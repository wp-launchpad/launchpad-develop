<?php

namespace LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

	/**
	 * @inheritDoc
	 */
	protected function define() {

		$this->register_common_subscriber(EnabledSubscriber::class);
		$this->register_common_subscriber(Subscriber::class);

		$this->register_service(Context::class);
		$this->register_service(EnabledContext::class);
	}
}