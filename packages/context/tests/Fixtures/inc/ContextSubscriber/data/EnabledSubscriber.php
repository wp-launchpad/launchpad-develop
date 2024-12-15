<?php

namespace LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data;

class EnabledSubscriber {
	/**
	 * @context LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\EnabledContext
	 *
	 * @hook test
	 */
	public function my_callback() {
		update_option('my_option', true);
	}
}