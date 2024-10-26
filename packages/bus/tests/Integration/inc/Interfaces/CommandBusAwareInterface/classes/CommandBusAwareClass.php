<?php

namespace LaunchpadBus\Tests\Integration\inc\Interfaces\CommandBusAwareInterface\classes;

use LaunchpadBus\Interfaces\CommandBusAwareInterface;
use LaunchpadBus\Traits\CommandBusAware;

class CommandBusAwareClass implements CommandBusAwareInterface
{
    use CommandBusAware;
}