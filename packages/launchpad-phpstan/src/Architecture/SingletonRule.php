<?php

namespace Launchpad\PHPStan\Architecture;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

class SingletonRule implements Rule {

	private $reflectionProvider;

	public function __construct(ReflectionProvider $reflectionProvider)
	{
		$this->reflectionProvider = $reflectionProvider;
	}


	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return \PhpParser\Node\Stmt\ClassMethod::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {

		if( ! $node instanceof \PhpParser\Node\Stmt\ClassMethod) {
			return [];
		}

		if('__construct' !== $node->name->toString()) {
			return [];
		}

		$reflected = $scope->getClassReflection()->getNativeReflection();

		if ($node->isPublic()) {
			return [];
		}

		$statics = [];

		foreach ( $reflected->getProperties() as $property ) {
			if( ! $property->isStatic()) {
				continue;
			}

			$statics []= $property;
		}

		if(0 === count($statics)) {
			return [];
		}

		$methods = [];

		foreach ($reflected->getMethods() as $method) {
			if( ! $method->isStatic() || ! $method->isPublic()) {
				continue;
			}

			if( ! in_array($method->getReturnType()->getName(), ['self', 'static', $reflected->getName()])) {
				continue;
			}

			$methods []= $method;
		}

		if( 0 == count($methods)) {
			return [];
		}

		return [
			RuleErrorBuilder::message(
				'Singletons classes should not be done directly, instead delegate them to the container using the share feature.'
			)
							->identifier('launchpad.architecture.singleton')
							->build(),
		];
	}
}