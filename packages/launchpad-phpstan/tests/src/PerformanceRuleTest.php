<?php

namespace Launchpad\PHPStan\Tests\src;

use Launchpad\PHPStan\PerformanceRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class PerformanceRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new PerformanceRule();
	}

	public function testPrefixedRule() {
		$this->analyse([__DIR__ . '/data/performance-rule/regular.php'], [
			[
				'Method get on the container should not be called inside a provider define method for performances issues.', // asserted error message
				16, // asserted error line
			],
		]);
	}
}