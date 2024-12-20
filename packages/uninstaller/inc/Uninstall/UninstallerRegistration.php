<?php

namespace LaunchpadUninstaller\Uninstall;

use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareInterface;
use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareTrait;
use LaunchpadCore\Container\Registration\Registration;

class UninstallerRegistration extends Registration implements AutowireAwareInterface {
	use AutowireAwareTrait;
}