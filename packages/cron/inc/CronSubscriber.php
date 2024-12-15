<?php

namespace LaunchpadCron;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use ReflectionClass;

class CronSubscriber implements PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    /**
     * Schedules to register.
     *
     * @var array
     */
    protected $schedules;

    /**
     * Events to schedule.
     *
     * @var array
     */
    protected $events;

    /**
     * Instantiate the class.
     */
    public function __construct()
    {
        $this->events = [];
        $this->schedules = [];
    }


    /**
     * Parse the cron annotations.
     *
     * @hook $prefixcore_subscriber_events
     *
     * @param array $events Class events.
     * @param string $classname Classname.
     * @return array
     */
    public function parse_crons($events, $classname) {
        if(! is_array($events)) {
            return $events;
        }

        $methods          = get_class_methods( $classname );
        $reflection_class = new ReflectionClass( $classname );
        foreach ( $methods as $method ) {
            $method_reflection   = $reflection_class->getMethod( $method );
            $doc_comment         = $method_reflection->getDocComment();
            if ( ! $doc_comment ) {
                continue;
            }
            $pattern = '#@cron\s(?<name>[a-zA-Z\\-_$/]+)(\s(?<priority>[0-9]+))?(\s(?<schedule>[a-zA-Z\\-_$/]+))#';

            preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
            if ( ! $matches ) {
                continue;
            }

            foreach ( $matches[0] as $index => $match ) {
                $hook = $matches['name'][ $index ];
                $hook = str_replace( '$prefix', $this->prefix, $hook );
                $hook = $this->dispatcher->apply_string_filters("{$this->prefix}core_subscriber_event_hook", $hook, $classname);

                $events[ $hook ][] = [
                    $method,
                    key_exists( 'priority', $matches ) && key_exists( $index, $matches['priority'] ) && '' !== $matches['priority'][ $index ] ? (int) $matches['priority'][ $index ] : 10,
                    $method_reflection->getNumberOfParameters(),
                ];

                $this->events[ $hook ] = $matches['schedule'][$index];
            }
        }

        $constants = $reflection_class->getConstants();

        foreach ( $constants as $name => $value ) {
            $reflection_constant = $reflection_class->getReflectionConstant($name);
            $doc_comment = $reflection_constant->getDocComment();
            if ( ! $doc_comment ) {
                continue;
            }
            $pattern = '#@cron-schedule\s(?<name>[a-zA-Z\\-_$/]+)#';
            preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );
            if ( ! $matches ) {
                continue;
            }
            foreach ( $matches[0] as $index => $match ) {
                $name = $matches['name'][ $index ];

                $this->schedules[ $name ] = $value;
            }
        }

        return $events;
    }

    /**
     * Register events.
     *
     * @hook init
     */
    public function register_events()
    {
        foreach ( $this->events as $event => $schedule ) {
            if ( wp_next_scheduled( $event ) ) {
                continue;
            }

            wp_schedule_event( time(), $schedule, $event );
        }
    }

    /**
     * Register schedules.
     *
     * @hook cron_schedules
     */
    public function register_schedules($schedules)
    {
        if( ! is_array($schedules)) {
            return $schedules;
        }

        foreach ($this->schedules as $schedule => $period) {
            if(key_exists($schedule, $schedules)) {
               continue;
            }
            $schedules[$schedule] = [
                'interval' => $period,
                'display' => $schedule,
            ];
        }

        return $schedules;
    }
}