<?php

namespace Launchpad\PHPStan\Hook;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\ObjectType;

class HeavyInitRule implements Rule {

	private $reflectionProvider;

	public function __construct(ReflectionProvider $reflectionProvider)
	{
		$this->reflectionProvider = $reflectionProvider;
	}
	/**
	 * @inheritDoc
	 */
	public function getNodeType(): string {
		return ClassMethod::class;
	}

	/**
	 * @inheritDoc
	 */
	public function processNode( Node $node, Scope $scope ): array {

		$count = 0;

		if( ! $node instanceof ClassMethod) {
			return [];
		}


		$docblock = $node->getDocComment();

		if( ! $docblock ) {
			return [];
		}

		$text = $docblock->getText();

		$text_line = $docblock->getStartLine();

		$results = [];

		if( ! preg_match_all('#@hook\s+init#', $text, $results)) {
			return [];
		}

		if( ! $scope->isInClass()) {
			return [];
		}

		$total = $this->count_dependencies($scope->getClassReflection(), $scope);

		if(15 > $total) {
			return [];
		}

		foreach ($results as $index => $result) {
			$errors[] = RuleErrorBuilder::message(
				'An @hook annotation init is on a heavy subscriber, for performance reasons you might want to isolate it.'
			)
										->identifier('launchpad.hooks.heavyInit')
										->line($text_line + $this->get_line($results[0][$index], $text))
										->build();
		}

		return $errors;
	}

	protected function count_dependencies(ClassReflection $class, Scope $scope): int {
		$count = 0;
		try {
			$variants = $class->getConstructor()->getVariants();
		} catch ( ShouldNotHappenException $e ) {
			return 0;
		}

		$parameters_to_analyze = [];

		foreach ($variants as $variant) {
			$parameters = $variant->getParameters();

			if(count($parameters_to_analyze) > count($parameters)) {
				continue;
			}

			$parameters_to_analyze = $parameters;
		}

		foreach ($parameters_to_analyze as $parameter) {
			$count ++;

			if( $parameter->getNativeType()->isObject()->no() ) {
				continue;
			}

			$class = $this->reflectionProvider->getClass($parameter->getType()->getClassName());

			$count += $this->count_dependencies($class, $scope);

		}

		return $count;
	}

	protected function get_line(string $search, string $text): int {
		$search = trim($search);

		$lines = explode("\n", $text);
		foreach ($lines as $index => $line) {
			if(strpos($line, $search) !== false) {
				return $index;
			}
		}

		return 0;
	}
}