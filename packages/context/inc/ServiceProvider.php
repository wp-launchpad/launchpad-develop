<?php

namespace LaunchpadContext;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_init_subscriber(ContextSubscriber::class);
	}
}