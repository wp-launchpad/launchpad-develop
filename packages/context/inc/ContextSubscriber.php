<?php

namespace LaunchpadContext;

use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use ReflectionClass;

class ContextSubscriber implements ContainerAwareInterface {

	use ContainerAwareTrait;

	protected $context_mapper;

	/**
	 * @param $context_mapper
	 */
	public function __construct() {
		$this->context_mapper = [];
	}


	/**
	 * @hook $prefixcore_subscriber_disable_callback
	 */
	public function trigger_context($activated, $classname, $method) {

		if(! key_exists("$classname::$method", $this->context_mapper)) {
			$this->context_mapper["$classname::$method"] = $this->load($classname, $method);
		}

        if(! $this->context_mapper["$classname::$method"]) {
            return $activated;
        }

        $id = ltrim($this->context_mapper["$classname::$method"], '\\');

		$context = $this->getContainer()->get($id);

		return $context($classname, $method);
	}

	protected function load(string $classname, string $method) {

		$reflection_class = new ReflectionClass( $classname );
		$docblock         = $reflection_class->getDocComment() ? $reflection_class->getDocComment() : '';
		$context          = $this->fetch_context( $docblock );
		try {
			$method_reflection = $reflection_class->getMethod( $method );
		} catch ( \ReflectionException $e ) {
			return $context;
		}
		$doc_comment         = $method_reflection->getDocComment();
		if ( ! $doc_comment ) {
			return $context;
		}

		$method_context = $this->fetch_context( $doc_comment );

		if (! $method_context ) {
			return $context;
		}

		return $method_context;
	}

	/**
	 * Fetch context from the docblock.
	 *
	 * @param string $docblock Docblock to fetch from.
	 *
	 * @return string|null
	 */
	protected function fetch_context( string $docblock ) {
		if ( '' === $docblock ) {
			return null;
		}

		$pattern = '#@context\s(?<name>[a-zA-Z0-9\\\-_$/]+)#';

		preg_match( $pattern, $docblock, $match );
		if ( ! $match ) {
			return null;
		}

		if ( ! class_exists( $match['name'] ) ) {
			return null;
		}

		return $match['name'];
	}
}