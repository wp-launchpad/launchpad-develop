<?php

namespace LaunchpadAjax\Tests\Integration\inc;

use LaunchpadAjax\ServiceProvider;
use LaunchpadAjax\Tests\Integration\TestCase;
use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadDispatcher\Dispatcher;
use League\Container\Container;

class Test_ParseAjaxAnnotations extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected)
    {

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

        $this->assertSame($expected, $events);
    }
}