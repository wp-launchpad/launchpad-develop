<?php

namespace LaunchpadUninstaller\Uninstall\Wrapper;

use LaunchpadUninstaller\Uninstall\UninstallerInterface;

class UninstallerProxy implements UninstallerInterface {

	/**
	 * List of method to call.
	 *
	 * @var string[]
	 */
	protected $uninstall_methods = [];

	/**
	 * Any class uninstaller.
	 *
	 * @var object
	 */
	protected $instance;

	/**
	 * Instantiate the proxy.
	 *
	 * @param object $instance Any class uninstaller.
	 * @param array  $uninstall_methods List of method to call.
	 */
	public function __construct( $instance, array $uninstall_methods ) {
		$this->instance           = $instance;
		$this->uninstall_methods = $uninstall_methods;
	}

	/**
	 * @inheritDoc
	 */
	public function uninstall() {
		foreach ( $this->uninstall_methods as $method ) {
			$this->instance->{$method}();
		}
	}
}