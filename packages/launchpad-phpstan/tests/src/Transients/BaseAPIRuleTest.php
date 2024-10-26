<?php

namespace Launchpad\PHPStan\Tests\src\Transients;

use Launchpad\PHPStan\Transients\BaseAPIRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class BaseAPIRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new BaseAPIRule();
	}

	public function testShouldFlag() {
		$this->analyse([__DIR__ . '/../data/transients/base-api-rule/regular.php'], [
			[
				'Use Launchpad module to manipulate transients.',
				3,
				'composer require wp-launchpad/framework-options-take-off'
			],
			[
				'Use Launchpad module to manipulate transients.',
				5,
				'composer require wp-launchpad/framework-options-take-off'

			],
			[
				'Use Launchpad module to manipulate transients.',
				7,
				'composer require wp-launchpad/framework-options-take-off'
			]
		]);
	}
}