<?php

namespace LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data;

class EnabledContext {
	public function __invoke(...$values) {
		return true;
	}
}