<?php

namespace Launchpad\PHPStan\Exception;

use Exception;
use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ObjectType;
use PhpParser\Node\Name\FullyQualified;
class NoExceptionRule implements Rule {

	private $reflectionProvider;

	public function __construct(ReflectionProvider $reflectionProvider)
	{
		$this->reflectionProvider = $reflectionProvider;
	}

	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return \PhpParser\Node\Expr\New_::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {

		if( ! $node instanceof \PhpParser\Node\Expr\New_) {
			return [];
		}

		if( ! $node->class instanceof \PhpParser\Node\Name\FullyQualified) {
			return [];
		}

		$class = $node->class->toString();

		$reflected = $this->reflectionProvider->getClass($class);

		$classes = array_keys($reflected->getAncestors());

		if ( ! in_array(\Throwable::class, $classes, true)) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Exception are dangerous to manipule, consider using WP_Error.'
			)
							->identifier('launchpad.exceptions.dangerous')
							->build(),
		];
	}
}