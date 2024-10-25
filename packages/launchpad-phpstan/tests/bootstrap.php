<?php
namespace Launchpad\Dependencies\LaunchpadCore\Container;

abstract class AbstractServiceProvider {
	abstract protected function define();
}

class Options {

}

class Dependency {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @param Options $options
	 */
	public function __construct( Options $options ) {
		$this->options = $options;
	}

}


class SecondDependency {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @var Dependency
	 */
	protected $dependency;

	/**
	 * @param Options $options
	 * @param Dependency $dependency
	 */
	public function __construct( Options $options, Dependency $dependency ) {
		$this->options    = $options;
		$this->dependency = $dependency;
	}

}

class ThirdDependency {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @var Dependency
	 */
	protected $dependency;

	/**
	 * @var SecondDependency
	 */
	protected $second_dependency;

	/**
	 * @param Options $options
	 * @param Dependency $dependency
	 * @param SecondDependency $second_dependency
	 */
	public function __construct( Options $options, Dependency $dependency, SecondDependency $second_dependency ) {
		$this->options           = $options;
		$this->dependency        = $dependency;
		$this->second_dependency = $second_dependency;
	}

}

class FourthDependency {
	/**
	 * @var Options
	 */
	protected $options;

	/**
	 * @var Dependency
	 */
	protected $dependency;

	/**
	 * @var SecondDependency
	 */
	protected $second_dependency;

	/**
	 * @var ThirdDependency
	 */
	protected $third_dependency;

	/**
	 * @param Options $options
	 * @param Dependency $dependency
	 * @param SecondDependency $second_dependency
	 * @param ThirdDependency $third_dependency
	 */
	public function __construct( Options $options, Dependency $dependency, SecondDependency $second_dependency, ThirdDependency $third_dependency ) {
		$this->options           = $options;
		$this->dependency        = $dependency;
		$this->second_dependency = $second_dependency;
		$this->third_dependency  = $third_dependency;
	}

}

require_once __DIR__ . '/../vendor/autoload.php';