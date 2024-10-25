<?php

namespace LaunchpadBus\Traits;

use LaunchpadBus\Bus\Commands\BusInterface;

trait CommandBusAware
{
    /**
     * @var BusInterface
     */
    protected $command_bus;

    public function set_command_bus(BusInterface $bus): void
    {
        $this->command_bus = $bus;
    }
}