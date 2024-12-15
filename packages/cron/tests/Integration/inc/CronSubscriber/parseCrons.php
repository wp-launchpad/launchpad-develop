<?php
namespace LaunchpadCron\Tests\Integration\inc\CronSubscriber;

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadCron\ServiceProvider;
use LaunchpadDispatcher\Dispatcher;
use League\Container\Container;

class Test_parseCrons extends \LaunchpadCron\Tests\Integration\TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        $container = new Container();

        $event_manager = new EventManager();

        $dispatcher = new Dispatcher();

        $prefix = 'prefix_';

        $plugin = new Plugin($container, $event_manager, new SubscriberWrapper($prefix, $container, $dispatcher), $dispatcher);

        $plugin->load([
            'prefix' => $prefix,
            'version' => '3.16'
        ], [
            ServiceProvider::class,
        ]);

        $events = apply_filters("{$prefix}core_subscriber_events", $config['events'], $config['classname']);

        $schedules = apply_filters("cron_schedules", $config['schedules']);

        do_action('init');

        $this->assertSame($expected['events'], $events);
        $this->assertSame($expected['schedules'], $schedules);
        foreach ($expected['crons'] as $event => $schedule) {
            $scheduled_event = wp_get_scheduled_event($event);
            $this->assertNotFalse($scheduled_event);
            $this->assertSame($schedule, $scheduled_event->schedule);
        }
    }
}