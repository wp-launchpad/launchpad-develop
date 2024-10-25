<?php

namespace Container;

use Launchpad\PHPStan\Container\InflectorRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class InflectorRuleTest extends RuleTestCase {

	protected function getRule(): Rule {
		return new InflectorRule($this->createReflectionProvider());
	}

	public function testShouldNotRaise() {
		$this->analyse([__DIR__ . '/../data/container/inflector/regular.php'], []);
	}

	public function testShouldRaise() {
		$this->analyse([__DIR__ . '/../data/container/inflector/over-usage.php'], [
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				16,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				32,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				46,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				60,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				74,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				88,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				102,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				116,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				130,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
			[
				'Launchpad\Dependencies\LaunchpadCore\Container\Options is passed a lot as dependency, consider using an inflector',
				144,
				'https://wp-launchpad.gitbook.io/launchpad/container/inflectors'
			],
		]);
	}
}