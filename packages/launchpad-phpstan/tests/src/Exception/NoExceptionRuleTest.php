<?php

namespace Exception;

use Launchpad\PHPStan\Exception\NoExceptionRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class NoExceptionRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new NoExceptionRule($this->createReflectionProvider());
	}

	public function testWithNewExceptionShouldTrigger() {
		$this->analyse([__DIR__ . '/../data/exception/no-exception-rule/regular.php'], [
			[
				"Exception are dangerous to manipule, consider using WP_Error.",
				5
			],
			[
				"Exception are dangerous to manipule, consider using WP_Error.",
				9
			]
		]);
	}

	public function testNotRaisingShouldNotTrigger() {
		$this->analyse([__DIR__ . '/../data/exception/no-exception-rule/no-exception.php'], []);
	}
}