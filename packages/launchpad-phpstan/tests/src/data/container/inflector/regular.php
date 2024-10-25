<?php

use Launchpad\Dependencies\LaunchpadCore\Container\Options;

class Subscriber {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @param Options $options
	 */
	public function __construct( Options $options ) {
		$this->options = $options;
	}


}

class AdminSubscriber {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @param Options $options
	 */
	public function __construct( Options $options ) {
		$this->options = $options;
	}
}