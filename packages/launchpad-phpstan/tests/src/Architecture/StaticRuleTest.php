<?php

namespace Architecture;

use Launchpad\PHPStan\Architecture\StaticRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class StaticRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new StaticRule();
	}

	public function testHasStaticPropertyShouldFlag() {
		$this->analyse([__DIR__ . '/../data/architecture/static/property.php'], [
			[
				'Static properties are often the sign of a code smell, please consider twice before using some.',
				4
			]
		]);
	}

	public function testHasStaticMethodShouldFlag() {
		$this->analyse([__DIR__ . '/../data/architecture/static/method.php'], [
			[
				'Static methods are often the sign of a code smell, please consider twice before using some.',
				6
			]
		]);
	}

	public function testNoStaticShouldNotFlag() {
		$this->analyse([__DIR__ . '/../data/architecture/static/no-static.php'], []);
	}
}