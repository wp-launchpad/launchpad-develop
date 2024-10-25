<?php

namespace Hook;

use Launchpad\PHPStan\Hook\HeavyInitRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class HeavyInitRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new HeavyInitRule($this->createReflectionProvider());
	}

	public function testShouldFire() {
		$this->analyse([__DIR__ . '/../data/hook/heavy-init/regular.php'], [
			[
				'An @hook annotation init is on a heavy subscriber, for performance reasons you might want to isolate it.',
				49
			]
		]);
	}

	public function testShouldNotFire() {
		$this->analyse([__DIR__ . '/../data/hook/heavy-init/normal-class.php'], [
		]);
	}
}