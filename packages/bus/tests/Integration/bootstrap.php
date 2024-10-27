<?php
namespace Launchpad\Tests\Integration;
use LaunchpadBus\ServiceProvider;
use LaunchpadDispatcher\Dispatcher;
use WPMedia\PHPUnit\BootstrapManager;

define( 'LAUNCHPAD_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'LAUNCHPAD_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'LAUNCHPAD_TESTS_DIR', __DIR__ );
define( 'LAUNCHPAD_IS_TESTING', true );

use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use League\Container\Container;

// Manually load the plugin being tested.
tests_add_filter(
    'muplugins_loaded',
    function() {

        if ( BootstrapManager::isGroup( '' ) ) {
            // TODO: add your logic from .
        }

		$container = new Container();
		$prefix = 'test';

        $plugin = new Plugin($container, new EventManager(), new SubscriberWrapper($prefix, $container), new Dispatcher());
        $plugin->load([
            'prefix' => $prefix,
            'version' => '3.16'
        ], [
            ServiceProvider::class,
        ]);
    }
);