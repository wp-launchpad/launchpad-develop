<?php

namespace LaunchpadUninstaller\Tests\Integration\inc\boot;

use LaunchpadDispatcher\Dispatcher;
use LaunchpadUninstaller\Tests\Integration\TestCase;
use LaunchpadUninstaller\Uninstall\Uninstall;
use League\Container\Container;
use function LaunchpadCore\boot;

class Test_Uninstall extends TestCase {

	public function set_up()
	{
		parent::set_up();
		update_option('demo_option', true);
		update_option('demo_option_2', true);
	}

	public function tear_down()
	{
		delete_option('demo_option_2');
		delete_option('demo_option');
		parent::tear_down();
	}

	/**
	 * @dataProvider configTestData
	 */
	public function testShouldDoAsExpected($config, $expected)
	{
		require_once LAUNCHPAD_PLUGIN_ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'wp-launchpad' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'boot.php';

		$plugin_root_dir = $config['plugin'];

		$params = require_once $plugin_root_dir . '/configs/parameters.php';
		$providers = require_once $plugin_root_dir . '/configs/providers.php';


		$container = new Container();
		if( key_exists('autowiring', $params) && $params['autowiring']) {
			$reflection_container = new \LaunchpadCore\Container\Autowiring\Container();
			$container->delegate( $reflection_container );
		}

		Uninstall::set_container($container);
		Uninstall::set_dispatcher(new Dispatcher());
		Uninstall::set_params($params);
		Uninstall::set_providers($providers);

		Uninstall::uninstall_plugin();

		$this->assertFalse(get_option('demo_option', false), "demo_option should be unregistered");
		$this->assertFalse(get_option('demo_option_2', false), "demo_option_2 should be unregistered");
	}
}