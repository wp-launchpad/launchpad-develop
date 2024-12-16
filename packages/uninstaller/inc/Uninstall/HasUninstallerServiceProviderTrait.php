<?php

namespace LaunchpadUninstaller\Uninstall;

use LaunchpadCore\Container\Registration\DeactivatorRegistration;
use LaunchpadCore\Container\Registration\Registration;

trait HasUninstallerServiceProviderTrait {
	/**
	 * Returns list of uninstallers.
	 *
	 * @return string[]
	 */
	public function get_uninstallers(): array {
		$this->load();

		$uninstallers = [];

		foreach ( $this->get_services_to_load() as $registration ) {
			if ( ! $registration instanceof UninstallerRegistration ) {
				continue;
			}

			$uninstallers [] = $registration->get_id();
		}

		return $uninstallers;
	}

	/**
	 * Register uninstaller.
	 *
	 * @param string $classname Classname from the uninstaller.
	 * @return UninstallerRegistration
	 */
	public function register_uninstaller( string $classname ): UninstallerRegistration {
		$registration = new UninstallerRegistration( $classname );

		$this->add_service_to_load( $registration );

		return $registration;
	}

	/**
	 * Loads definitions.
	 *
	 * @return void
	 */
	abstract protected function load();

	/**
	 * Get the service to load.
	 *
	 * @return Registration[]
	 */
	abstract protected function get_services_to_load(): array;

	/**
	 * Add to the list of service to load.
	 *
	 * @param Registration $registration Registration from the service to add.
	 * @return void
	 */
	abstract protected function add_service_to_load( Registration $registration ): void;
}