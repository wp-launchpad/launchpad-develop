<?php

namespace Launchpad\PHPStan\Container;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use \PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ObjectType;

class InflectorRule implements Rule {

	protected $count = [];

	protected $args = [];

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

		if(! $node instanceof ClassMethod) {
			return [];
		}

		if('__construct' !== (string) $node->name) {
			return [];
		}

		foreach ($node->getParams() as $param) {

			$type = ((string) $param->type);

			if( ! $this->reflectionProvider->hasClass($type) ) {
				continue;
			}

			if (! key_exists($type, $this->count)) {
				$this->count[$type] = 0;
			}

			$this->count[$type] ++;

			$this->args[$type][] = [
				'node' => $node,
				'file' => $scope->getFile()
			];
		}

		$errors = [];

		foreach ($this->args as $type => $rules) {
			if($this->count[$type] < 10) {
				continue;
			}

			foreach ($rules as $rule) {
				$errors []= RuleErrorBuilder::message(
					"$type is passed a lot as dependency, consider using an inflector"
				)
											->addTip('https://wp-launchpad.gitbook.io/launchpad/container/inflectors')
											->identifier('launchpad.container.inflector')
											->line($rule['node']->getLine())
											->file($rule['file'])
											->build();
			}

			$this->args[$type] = [];
		}

		return $errors;

	}
}