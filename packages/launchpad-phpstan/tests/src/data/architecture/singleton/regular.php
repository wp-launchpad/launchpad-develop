<?php

class Subscriber {

	protected static $instance = null;

	protected function __construct() {

	}

	public static function instantiate(): self {
		if( ! self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function my_event() {

	}
}