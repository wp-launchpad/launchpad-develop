<?php

namespace Integration\inc\ContextSubscriber;

use LaunchpadContext\ServiceProvider;
use LaunchpadContext\Tests\Integration\TestCase;
use LaunchpadCore\EventManagement\EventManager;
use LaunchpadCore\EventManagement\Wrapper\SubscriberWrapper;
use LaunchpadCore\Plugin;
use LaunchpadDispatcher\Dispatcher;
use League\Container\Container;

class Test_TriggerContext extends TestCase {
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
			\LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\ServiceProvider::class,
		]);

		$enabled = apply_filters("{$prefix}core_subscriber_disable_callback", true, $config['subscriber'], $config['method']);
		$this->assertSame($expected['called'], $enabled);
	}
}