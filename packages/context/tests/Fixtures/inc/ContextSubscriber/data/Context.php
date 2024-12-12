<?php

namespace Fixtures\inc\ContextSubscriber\data;

class Context {
	public function __invoke(...$values) {
		return false;
	}
}