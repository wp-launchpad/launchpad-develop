<?php
namespace MyTestApp\Tests\Integration;

define( 'MY_TEST_APP_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'MY_TEST_APP_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'MY_TEST_APP_TESTS_DIR', __DIR__ );
define( 'MY_TEST_APP_IS_TESTING', true );

// Manually load the plugin being tested.
tests_add_filter(
    'muplugins_loaded',
    function() {
        // Load the plugin.
        require MY_TEST_APP_PLUGIN_ROOT . '/my-test-app.php';
    }
);
