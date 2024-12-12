<?php

namespace LaunchpadContext;

class ContextSubscriber {

	protected $context_mapper;

	/**
	 * @hook $prefixcore_subscriber_disable_callback
	 */
	public function trigger_context($activated, $classname, $method) {
		
	}
}