<?php

namespace Launchpad\PHPStan\Assets;

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
			'wp_register_script',
			'wp_enqueue_script',
			'wp_enqueue_style',
			'wp_register_style',
		], true)) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Use Launchpad module to manipulate assets.'
			)
							->addTip('composer require wp-launchpad/front-take-off')
							->identifier('launchpad.hooks.assets.module')
							->build(),
		];
	}
}