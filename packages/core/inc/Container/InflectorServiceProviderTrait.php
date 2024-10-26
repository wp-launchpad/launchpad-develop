<?php

namespace LaunchpadCore\Container;

use LaunchpadCore\Container\Registration\InflectorRegistration;
use League\Container\Container;

trait InflectorServiceProviderTrait {

	/**
	 * List of inflectors.
	 *
	 * @var InflectorRegistration[]
	 */
	protected $inflectors = [];

	/**
	 * Returns inflectors mapping.
	 *
	 * @return array<string,array>
	 */
	public function get_inflectors(): array {
		$this->load();
		return $this->inflectors;
	}

	/**
	 * Register inflectors.
	 *
	 * @return void
	 */
	public function register_inflectors(): void {
		foreach ( $this->get_inflectors() as $class => $data ) {

			if ( $data instanceof InflectorRegistration ) {
				$data->register( $this->getLeagueContainer() );
				continue;
			}

			if ( ! is_array( $data ) || ! key_exists( 'method', $data ) ) {
				continue;
			}
			$method = $data['method'];

			if ( ! key_exists( 'args', $data ) || ! is_array( $data['args'] ) ) {
				$this->getLeagueContainer()->inflector( $class )->invokeMethod( $method, [] );
				continue;
			}

			$this->getLeagueContainer()->inflector( $class )->invokeMethod( $method, $data['args'] );
		}
	}

	/**
	 * Register an inflector.
	 *
	 * @param string $inflector_interface Interface the inflector is attached to.
	 *
	 * @return InflectorRegistration
	 */
	public function register_inflector( string $inflector_interface ): InflectorRegistration {
		$registration = new InflectorRegistration( $inflector_interface );

		$this->inflectors [] = $registration;

		return $registration;
	}

	/**
	 * Get the container.
	 *
	 * @return Container
	 */
	abstract public function getLeagueContainer(): Container; // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid

	/**
	 * Loads definitions.
	 *
	 * @return void
	 */
	abstract protected function load();
}
