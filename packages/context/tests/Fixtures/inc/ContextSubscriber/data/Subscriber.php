<?php

namespace LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data;

class Subscriber {
	/**
	 * @context LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\Context
	 *
	 * @hook test
	 */
	public function my_callback() {
		update_option('my_option', true);
	}
}