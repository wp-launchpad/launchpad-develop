<?php

namespace Launchpad\PHPStan\Architecture;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class StaticRule implements Rule {

	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return \PhpParser\Node\Stmt::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {
		if( $node instanceof \PhpParser\Node\Stmt\Property) {
			return $this->process_property($node);
		}

		if( $node instanceof \PhpParser\Node\Stmt\ClassMethod) {
			return $this->process_method($node);
		}

		return [];
	}

	protected function process_property(\PhpParser\Node\Stmt\Property $node): array {
		if($node->isStatic()) {
			return [
				RuleErrorBuilder::message(
					'Static properties are often the sign of a code smell, please consider twice before using some.'
				)
								->identifier('launchpad.architecture.static')
								->build(),
			];
		}
		return [];
	}

	protected function process_method(\PhpParser\Node\Stmt\ClassMethod $node): array {
		if($node->isStatic()) {
			return [
				RuleErrorBuilder::message(
					'Static methods are often the sign of a code smell, please consider twice before using some.'
				)
								->identifier('launchpad.architecture.static')
								->build(),
			];
		}
		return [];
	}
}