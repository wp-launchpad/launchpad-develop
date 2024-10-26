<?php

namespace Architecture;

use Launchpad\PHPStan\Architecture\SingletonRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class SingletonRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new SingletonRule($this->createReflectionProvider());
	}

	public function testWithSingletonShouldFire() {
		$this->analyse([__DIR__ . '/../data/architecture/singleton/regular.php'], [
			[
				'Singletons classes should not be done directly, instead delegate them to the container using the share feature.',
				7
			]
		]);
	}

	public function testWithoutSingletonShouldNotFire() {
		$this->analyse([__DIR__ . '/../data/architecture/singleton/no-singleton.php'], []);
	}
}