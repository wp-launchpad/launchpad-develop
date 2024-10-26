<?php

class Subscriber {

	/**
	 * @var \Launchpad\Dependencies\LaunchpadCore\Container\Options
	 */
	protected $options;

	/**
	 * @param \Launchpad\Dependencies\LaunchpadCore\Container\Options $options
	 */
	public function __construct( \Launchpad\Dependencies\LaunchpadCore\Container\Options $options ) {
		$this->options = $options;
	}

	/**
	 * @hook init
	 */
	public function callback() {

	}
}