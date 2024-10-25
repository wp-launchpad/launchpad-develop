<?php

namespace LaunchpadCore\Container\Registration;

use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareInterface;
use LaunchpadCore\Container\Registration\Autowiring\AutowireAwareTrait;

class DeactivatorRegistration extends Registration implements AutowireAwareInterface {

	use AutowireAwareTrait;
}
