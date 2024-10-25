<?php
declare(strict_types=1);

namespace LaunchpadOptions\Interfaces;

use LaunchpadOptions\Interfaces\Actions\DeleteInterface;
use LaunchpadOptions\Interfaces\Actions\FetchInterface;
use LaunchpadOptions\Interfaces\Actions\FetchPrefixInterface;
use LaunchpadOptions\Interfaces\Actions\SetInterface;

/**
 * Define mandatory methods to implement when using this package
 */
interface OptionsInterface extends FetchPrefixInterface, DeleteInterface, FetchInterface, SetInterface {
	/**
	 * Gets the option name used to store the option in the WordPress database.
	 *
	 * @param string $name Unprefixed name of the option.
	 * @deprecated Only for WP Rocket backward compatibility.
	 * @return string
	 */
	public function get_option_name( string $name ): string;
}
