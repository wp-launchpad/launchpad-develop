<?php
/**
 * Plugin Name: My test app
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mytestapp
 * Domain Path: /languages
 */

use function MyTestApp\Dependencies\RocketLauncherCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/inc/Dependencies/RocketLauncherCore/boot.php';

boot(__FILE__);
