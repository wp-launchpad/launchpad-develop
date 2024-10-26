<?php

use Launchpad\Dependencies\LaunchpadCore\Container\Dependency;
use Launchpad\Dependencies\LaunchpadCore\Container\SecondDependency;
use Launchpad\Dependencies\LaunchpadCore\Container\ThirdDependency;

class Subscriber {


	/**
	 * @var \Launchpad\Dependencies\LaunchpadCore\Container\Options
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


	protected $fourth_dependency;

	/**
	 * @param \Launchpad\Dependencies\LaunchpadCore\Container\Options $options
	 * @param Dependency $dependency
	 * @param SecondDependency $second_dependency
	 * @param ThirdDependency $third_dependency
	 * @param \Launchpad\Dependencies\LaunchpadCore\Container\FourthDependency $fourth_dependency
	 */
	public function __construct( \Launchpad\Dependencies\LaunchpadCore\Container\Options $options, Dependency $dependency, SecondDependency $second_dependency, ThirdDependency $third_dependency, \Launchpad\Dependencies\LaunchpadCore\Container\FourthDependency $fourth_dependency ) {
		$this->options           = $options;
		$this->dependency        = $dependency;
		$this->second_dependency = $second_dependency;
		$this->third_dependency  = $third_dependency;
		$this->fourth_dependency = $fourth_dependency;
	}

	/**
	 * @hook init
	 */
	public function callback() {

	}
}