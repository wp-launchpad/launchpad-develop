<?php

namespace Assets;

use Launchpad\PHPStan\Assets\BaseAPIRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class BaseAPIRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new BaseAPIRule();
	}

	public function testShouldFlag() {
		$this->analyse([__DIR__ . '/../data/assets/base-api-rule/regular.php'], [
			[
				'Use Launchpad module to manipulate assets.',
				17,
				'composer require wp-launchpad/front-take-off'
			],
			[
				'Use Launchpad module to manipulate assets.',
				18,
				'composer require wp-launchpad/front-take-off'
			],
			[
				'Use Launchpad module to manipulate assets.',
				19,
				'composer require wp-launchpad/front-take-off'
			],
			[
				'Use Launchpad module to manipulate assets.',
				20,
				'composer require wp-launchpad/front-take-off'
			],
		]);
	}
}