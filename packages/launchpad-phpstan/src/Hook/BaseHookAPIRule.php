<?php

namespace Launchpad\PHPStan\Hook;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class BaseHookAPIRule implements Rule {

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

		if( in_array($name, [
			'add_filter',
			'add_action',
		], true)) {
			return [
				RuleErrorBuilder::message(
					'Adding a callback for a filter or an action should be done using the dispatcher or the @hook annotation.'
				)
								->identifier('launchpad.hooks.baseHookApi.callback')
								->build(),
			];
		}

		if(in_array($name, [
			'do_action',
			'apply_filters'
		], true)) {
			return [
				RuleErrorBuilder::message(
					'Firing a hook should be done thought the dispatcher.'
				)
								->identifier('launchpad.hooks.baseHookApi.fire')
								->build(),
			];
		}

		return [];
	}
}