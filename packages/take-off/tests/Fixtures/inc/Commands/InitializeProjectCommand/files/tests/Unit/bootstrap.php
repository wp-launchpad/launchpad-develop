<?php

namespace MyTestApp\Tests\Unit;

define( 'MY_TEST_APP_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'MY_TEST_APP_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'MY_TEST_APP_TESTS_DIR', __DIR__ );
define( 'MY_TEST_APP_IS_TESTING', true );

define( 'OBJECT', 'OBJECT' );
/**
 * The original files need to loaded into memory before we mock them with Patchwork. Add files here before the unit
 * tests start.
 *
 */
function load_original_files_before_mocking() {
    $originals = [

    ];
    foreach ( $originals as $file ) {
        require_once MY_TEST_APP_PLUGIN_ROOT . $file;
    }

    $fixtures = [
        '/classes/WP.php',
        '/classes/WP_Error.php',
        '/classes/wpdb.php',
        '/classes/WPDieException.php',
    ];
    foreach ( $fixtures as $file ) {
        require_once MY_TEST_APP_TESTS_FIXTURES_DIR . $file;
    }
}

load_original_files_before_mocking();
require_once MY_TEST_APP_PLUGIN_ROOT . 'inc/compat.php';
