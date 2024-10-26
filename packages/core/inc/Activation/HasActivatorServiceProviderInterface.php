<?php

namespace LaunchpadCore\Activation;

interface HasActivatorServiceProviderInterface extends ActivationServiceProviderInterface {

	/**
	 * Returns list of activators.
	 *
	 * @return string[]
	 */
	public function get_activators(): array;
}
