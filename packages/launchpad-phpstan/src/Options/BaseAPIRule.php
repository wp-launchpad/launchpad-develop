<?php

namespace Launchpad\PHPStan\Options;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class BaseAPIRule implements Rule {

	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return \PhpParser\Node\Expr\FuncCall::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {
		$name = (string) $node->name;

		if( ! in_array($name, [
			'update_option',
			'add_option',
			'get_option',
			'delete_option',
		], true)) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Use Launchpad module to manipulate options.'
			)
			->addTip('composer require wp-launchpad/framework-options-take-off')
			->identifier('launchpad.hooks.options.module')
			->build(),
		];
	}
}