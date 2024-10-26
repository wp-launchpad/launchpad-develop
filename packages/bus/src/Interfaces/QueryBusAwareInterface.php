<?php

namespace LaunchpadBus\Interfaces;


use LaunchpadBus\Bus\Queries\BusInterface;

interface QueryBusAwareInterface
{
    public function set_query_bus(BusInterface $bus): void;
}