<?php

namespace Launchpad\PHPStan\Tests\src\Options;

use Launchpad\PHPStan\Options\BaseAPIRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class BaseAPIRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new BaseAPIRule();
	}

	public function testShouldFlag() {
		$this->analyse([__DIR__ . '/../data/options/base-api-rule/regular.php'], [
			[
				'Use Launchpad module to manipulate options.',
				3,
				'composer require wp-launchpad/framework-options-take-off'
			],
			[
				'Use Launchpad module to manipulate options.',
				5,
				'composer require wp-launchpad/framework-options-take-off'

			],
			[
				'Use Launchpad module to manipulate options.',
				7,
				'composer require wp-launchpad/framework-options-take-off'
			]
		]);
	}
}