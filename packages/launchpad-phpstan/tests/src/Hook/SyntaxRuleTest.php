<?php

namespace Launchpad\PHPStan\Tests\src\Hook;

use Launchpad\PHPStan\Hook\SyntaxRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class SyntaxRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new SyntaxRule();
	}

	public function testRegular() {
		$this->analyse([__DIR__ . '/../data/hook/syntax-rule/regular.php'], []);
	}

	public function testMissingHook() {
		$this->analyse([__DIR__ . '/../data/hook/syntax-rule/missing-hook.php'], [
			[
				'An @hook annotation needs to be used at least with a hook name.',
				10
			]
		]);
	}

	public function testTooMuchParameters() {
		$this->analyse([__DIR__ . '/../data/hook/syntax-rule/too-much-parameters.php'], [
			[
				'An @hook annotation can have at maximum 2 arguments: the hook and the priority',
				10
			]
		]);
	}

	public function testOutOfClass() {
		$this->analyse([__DIR__ . '/../data/hook/syntax-rule/out-of-class.php'], []);
	}
}