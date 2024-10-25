<?php

namespace LaunchpadLogger;

interface LoggerInterface {
	/**
	 * Adds a log record at the DEBUG level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function debug( $message, array $context = [] );

	/**
	 * Adds a log record at the INFO level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function info( $message, array $context = [] );

	/**
	 * Adds a log record at the NOTICE level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function notice( $message, array $context = [] );

	/**
	 * Adds a log record at the WARNING level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function warning( $message, array $context = [] );


	/**
	 * Adds a log record at the ERROR level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function error( $message, array $context = [] );


	/**
	 * Adds a log record at the CRITICAL level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function critical( $message, array $context = [] );

	/**
	 * Adds a log record at the ALERT level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function alert( $message, array $context = [] );

	/**
	 * Adds a log record at the EMERGENCY level.
	 *
	 * @access public
	 *
	 * @param  string $message The log message.
	 * @param  array  $context The log context.
	 * @return bool|null       Whether the record has been processed.
	 */
	public function emergency( $message, array $context = [] );

	/**
	 * Tell if debug is enabled.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function debug_enabled();


	/**
	 * Enable debug mode by adding a constant in the `wp-config.php` file.
	 *
	 * @access public
	 */
	public function enable_debug();

	/**
	 * Disable debug mode by removing the constant in the `wp-config.php` file.
	 *
	 * @access public
	 */
	public function disable_debug();
}
