<?php

namespace Launchpad\PHPStan\Hook;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class SyntaxRule implements Rule {

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

		if( ! preg_match_all('#@hook(\s+(?<name>[a-zA-Z0-9\\\-_$/]+))?(\s+(?<priority>[0-9]+))?(?<extra>[^\n\r]+)?#', $text, $results)) {
			return [];
		}

		$errors = [];

		foreach ($results[0] as $index => $match) {
			if( ! $results['name'][$index]) {

				$errors[] = RuleErrorBuilder::message(
					'An @hook annotation needs to be used at least with a hook name.'
				)
				->identifier('launchpad.hooks.hookName')
				->line($text_line + $this->get_line($results[0][$index], $text))
				->build();
				continue;
			}

			if($results['extra'][$index]) {
				$errors[] = RuleErrorBuilder::message(
					'An @hook annotation can have at maximum 2 arguments: the hook and the priority'
				)
				->identifier('launchpad.hooks.extra')
				->line($text_line + $this->get_line($results[0][$index], $text))
				->build();
				continue;
			}
		}

		return $errors;
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