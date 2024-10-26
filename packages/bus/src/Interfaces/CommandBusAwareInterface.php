<?php

namespace LaunchpadBus\Interfaces;
use LaunchpadBus\Bus\Commands\BusInterface;

interface CommandBusAwareInterface
{
    public function set_command_bus(BusInterface $bus): void;
}