<?php

namespace LaunchpadFrameworkConstants\Tests\Integration\inc;

use LaunchpadConstants\Constants;
use LaunchpadConstants\ConstantsInterface;
use LaunchpadConstants\PrefixedConstants;
use LaunchpadConstants\PrefixedConstantsInterface;
use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadDispatcher\Dispatcher;
use LaunchpadFrameworkConstants\Tests\Integration\TestCase;
use League\Container\Container;

class ServiceProvider extends TestCase
{
    public function testShouldReturnAsExpected()
    {
        $container = new Container();

        $event_manager = new EventManager();

        $dispatcher = new Dispatcher();

        $prefix = 'prefix_';

        $plugin = new Plugin($container, $event_manager, new SubscriberWrapper($prefix), $dispatcher);

        $plugin->load([
            'prefix' => $prefix,
            'version' => '3.16'
        ], [
            \LaunchpadFrameworkConstants\ServiceProvider::class,
            \LaunchpadFrameworkConstants\Tests\Integration\inc\files\ServiceProvider::class,
        ]);

        $this->assertInstanceOf(Constants::class, $container->get(ConstantsInterface::class));
        $this->assertInstanceOf(PrefixedConstants::class, $container->get(PrefixedConstantsInterface::class));

        do_action('test');
    }
}