<?php
namespace RocketLauncher\Tests\Integration;

define( 'LAUNCHPAD_BUILD_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'LAUNCHPAD_BUILD_TESTS_DIR', __DIR__ );
define( 'LAUNCHPAD_BUILD_IS_TESTING', true );

// Manually load the plugin being tested.
tests_add_filter(
    'muplugins_loaded',
    function() {
        // Load the plugin.
        require LAUNCHPAD_BUILD_PLUGIN_ROOT . '/rocket-launcher.php';
    }
);
