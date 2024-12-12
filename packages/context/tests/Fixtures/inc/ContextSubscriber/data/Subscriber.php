<?php

namespace Fixtures\inc\ContextSubscriber\data;

class Subscriber {
	/**
	 * @context \Fixtures\inc\ContextSubscriber\data\Context
	 *
	 * @hook test
	 */
	public function my_callback() {
		update_option('my_option', true);
	}
}