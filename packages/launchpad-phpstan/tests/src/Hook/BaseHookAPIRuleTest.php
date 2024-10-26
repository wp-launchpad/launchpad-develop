<?php

namespace Launchpad\PHPStan\Tests\src\Hook;

use Launchpad\PHPStan\Hook\BaseHookAPIRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class BaseHookAPIRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new BaseHookAPIRule();
	}

	public function testRegularShouldSignal() {
		$this->analyse([__DIR__ . '/../data/hook/base-hook-api-rule/regular.php'], [
			[
				'Adding a callback for a filter or an action should be done using the dispatcher or the @hook annotation.', // asserted error message
				3, // asserted error line
			],
			[
				'Adding a callback for a filter or an action should be done using the dispatcher or the @hook annotation.', // asserted error message
				7, // asserted error line
			],
		]);
	}

	public function testFiringShouldSignal() {
		$this->analyse([__DIR__ . '/../data/hook/base-hook-api-rule/firing.php'], [
			[
				'Firing a hook should be done thought the dispatcher.', // asserted error message
				3, // asserted error line
			],
			[
				'Firing a hook should be done thought the dispatcher.', // asserted error message
				5, // asserted error line
			],
		]);
	}
}