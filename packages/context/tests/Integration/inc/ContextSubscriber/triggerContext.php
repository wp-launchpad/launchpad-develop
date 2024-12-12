<?php

namespace Integration\inc\ContextSubscriber;

use LaunchpadContext\Tests\Integration\TestCase;

class Test_TriggerContext extends TestCase {
	public function testShouldDoAsExpected($config, $expected) {
		apply_filters('', true, $config['subscriber'], $config['method']);
	}
}