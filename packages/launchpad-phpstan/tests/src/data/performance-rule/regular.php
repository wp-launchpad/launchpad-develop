<?php

namespace Launchpad\Subnamespace;

use Launchpad\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

	/**
	 * Define your services.
	 *
	 * @return void
	 */
	protected function define() {
		// Add your services.
		$test = $this->getContainer()->get( '' );
	}
}
