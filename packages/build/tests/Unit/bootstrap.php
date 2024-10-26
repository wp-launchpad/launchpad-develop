<?php

namespace Launchpad\Tests\Unit;

define( 'LAUNCHPAD_BUILD_PLUGIN_ROOT', dirname( dirname( __DIR__ ) ) . DIRECTORY_SEPARATOR );
define( 'LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR', dirname( __DIR__ ) . '/Fixtures' );
define( 'LAUNCHPAD_BUILD_TESTS_DIR', __DIR__ );
define( 'LAUNCHPAD_BUILD_IS_TESTING', true );

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
        require_once LAUNCHPAD_BUILD_PLUGIN_ROOT . $file;
    }

    $fixtures = [
    ];
    foreach ( $fixtures as $file ) {
        require_once LAUNCHPAD_BUILD_TESTS_FIXTURES_DIR . $file;
    }
}

load_original_files_before_mocking();
require_once LAUNCHPAD_BUILD_PLUGIN_ROOT . 'inc/compat.php';
