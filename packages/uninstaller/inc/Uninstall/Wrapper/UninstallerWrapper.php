<?php

namespace LaunchpadUninstaller\Uninstall\Wrapper;

use LaunchpadUninstaller\Uninstall\UninstallerInterface;
use ReflectionClass;

class UninstallerWrapper {
	/**
	 * Wrap an uninstaller will the common interface for uninstallers.
	 *
	 * @param object $instance Any class uninstaller.
	 *
	 * @return UninstallerInterface
	 */
	public function wrap( $instance ): UninstallerInterface {
		if ( $instance instanceof UninstallerInterface ) {
			return $instance;
		}

		$methods            = get_class_methods( $instance );
		$reflection_class   = new ReflectionClass( get_class( $instance ) );
		$uninstall_methods = [];

		foreach ( $methods as $method ) {
			$method_reflection = $reflection_class->getMethod( $method );
			$doc_comment       = $method_reflection->getDocComment();
			if ( ! $doc_comment ) {
				continue;
			}
			$pattern = '#@uninstall#';

			$matched = preg_match_all( $pattern, $doc_comment, $matches, PREG_PATTERN_ORDER );

			if ( ! $matched ) {
				continue;
			}

			$uninstall_methods[] = $method;
		}

		return new UninstallerProxy( $instance, $uninstall_methods );
	}
}