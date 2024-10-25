<?php

namespace LaunchpadActionScheduler\Queue;

use ActionScheduler_Abstract_QueueRunner;
use ActionScheduler_AsyncRequest_QueueRunner;
use ActionScheduler_FatalErrorMonitor;
use ActionScheduler_Lock;
use ActionScheduler_Compatibility;
use ActionScheduler_QueueCleaner;
use ActionScheduler_Store;

abstract class AbstractQueueRunner extends ActionScheduler_Abstract_QueueRunner
{
    protected $prefix = '';

    protected $translation_key = '';

    protected $group;

    /**
     * Async Request Queue Runner instance.
     * We used the default one from AS.
     *
     * @var ActionScheduler_AsyncRequest_QueueRunner Instance.
     */
    protected $async_request;

    /**
     * Check if environment is compatible.
     *
     * @var ActionScheduler_Compatibility
     */
    protected $compatibility;

    /**
     * Lock action scheduler.
     *
     * @var ActionScheduler_Lock
     */
    protected $locker;


    /**
     * ActionScheduler_QueueRunner constructor.
     *
     * @param ActionScheduler_Store|null                    $store Store Instance.
     * @param ActionScheduler_FatalErrorMonitor|null        $monitor Fatal Error monitor instance.
     * @param ActionScheduler_QueueCleaner|null             $cleaner Cleaner instance.
     * @param ActionScheduler_AsyncRequest_QueueRunner|null $async_request Async Request Queue Runner instance.
     * @param ActionScheduler_Compatibility|null             $compatibility Check if environment is compatible.
     * @param ActionScheduler_Lock|null                     $locker Lock action scheduler.
     */
    public function __construct( string $group, string $prefix, string $translation_key, ActionScheduler_Store $store = null, ActionScheduler_FatalErrorMonitor $monitor = null, ActionScheduler_QueueCleaner $cleaner = null, ActionScheduler_AsyncRequest_QueueRunner $async_request = null, ActionScheduler_Compatibility $compatibility = null, ActionScheduler_Lock $locker = null ) {

        parent::__construct( $store, $monitor, $cleaner );
        $this->async_request = $async_request;
        $this->compatibility = $compatibility;
        $this->locker        = $locker;
        $this->group = $group;
        $this->prefix = $prefix;
        $this->translation_key = $translation_key;
    }

    /**
     * Run batch.
     *
     * @param string[] $context context from the batch.
     * @return int
     */
    public function run( $context = 'WP Cron' ) {
        do_action( "{$this->prefix}action_scheduler_before_process_queue" );
        $this->compatibility->raise_memory_limit();
        $this->compatibility->raise_time_limit( $this->get_time_limit() );
        $this->run_cleanup();
        $total = 0;

        if ( false === $this->has_maximum_concurrent_batches() ) {
            $batch_size = apply_filters( "{$this->prefix}action_scheduler_queue_runner_batch_size", 25 );
            do {
                $processed_actions_in_batch = $this->do_batch( $batch_size, $context );
                $total                     += $processed_actions_in_batch;
            } while ( $processed_actions_in_batch > 0 && ! $this->batch_limits_exceeded( $total ) );
        }

        do_action( "{$this->prefix}action_scheduler_after_process_queue" );
        return $total;
    }

    /**
     * Initialize the queue.
     *
     * @return void
     */
    public function init() {
        add_filter( 'cron_schedules', [ $this, 'add_wp_cron_schedule' ] );

        // Check for and remove any WP Cron hook scheduled by Action Scheduler < 3.0.0, which didn't include the $context param.
        $next_timestamp = wp_next_scheduled( $this->cron_hook_name() );
        if ( $next_timestamp ) {
            wp_unschedule_event( $next_timestamp, $this->cron_hook_name() );
        }

        $cron_context = [ 'WP Cron' ];

        if ( ! wp_next_scheduled( $this->cron_hook_name(), $cron_context ) ) {
            $schedule = apply_filters( "{$this->prefix}action_scheduler_run_schedule", $this->cron_hook_name() );
            wp_schedule_event( time(), $schedule, $this->cron_hook_name(), $cron_context );
        }

        add_action( $this->cron_hook_name(), [ $this, 'run' ] );
        add_action( 'shutdown', [ $this, 'maybe_dispatch_async_request' ] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
    }

    /**
     *  Hook check for dispatching an async request.
     *
     * @return void
     */
    public function maybe_dispatch_async_request() {
        if ( is_admin() && ! $this->locker->is_locked( 'async-request-runner' ) ) {
            // Only start an async queue at most once every 60 seconds.
            $this->locker->set( 'async-request-runner' );
            if ( ! $this->async_request ) {
                return;
            }
            $this->async_request->maybe_dispatch();
        }
    }

    /**
     * Process a batch of actions pending in the queue.
     *
     * Actions are processed by claiming a set of pending actions then processing each one until either the batch
     * size is completed, or memory or time limits are reached, defined by @see $this->batch_limits_exceeded().
     *
     * @param int    $size The maximum number of actions to process in the batch.
     * @param string $context Optional identifer for the context in which this action is being processed, e.g. 'WP CLI' or 'WP Cron'
     *        Generally, this should be capitalised and not localised as it's a proper noun.
     * @return int The number of actions processed.
     */
    public function do_batch( $size = 100, $context = '' ) {
        try {
            $claim = $this->store->stake_claim( $size, null, [], $this->group );
            $this->monitor->attach( $claim );
            $processed_actions = 0;

            foreach ( $claim->get_actions() as $action_id ) {
                // bail if we lost the claim.
                if ( ! in_array( $action_id, $this->store->find_actions_by_claim_id( $claim->get_id() ), true ) ) {
                    break;
                }
                $this->process_action( $action_id, $context );
                $processed_actions++;

                if ( $this->batch_limits_exceeded( $processed_actions ) ) {
                    break;
                }
            }
            $this->store->release_claim( $claim );
            $this->monitor->detach();
            $this->clear_caches();

            return $processed_actions;
        } catch ( \Exception $exception ) {

            return 0;
        }
    }

    abstract public function cron_hook_name(): string;


    /**
     * Running large batches can eat up memory, as WP adds data to its object cache.
     *
     * If using a persistent object store, this has the side effect of flushing that
     * as well, so this is disabled by default. To enable:
     *
     * add_filter( 'action_scheduler_queue_runner_flush_cache', '__return_true' );
     */
    protected function clear_caches() {
        if ( ! wp_using_ext_object_cache() || apply_filters( "{$this->prefix}action_scheduler_queue_runner_flush_cache", false ) ) {
            wp_cache_flush();
        }
    }

    /**
     * Add the cron schedule.
     *
     * @param array $schedules Array of current schedules.
     *
     * @return array
     */
    abstract public function add_wp_cron_schedule( $schedules );
}