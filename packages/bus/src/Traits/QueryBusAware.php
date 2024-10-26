<?php

namespace LaunchpadBus\Traits;

use LaunchpadBus\Bus\Queries\BusInterface;

trait QueryBusAware
{
    /**
     * @var BusInterface
     */
    protected $query_bus;

    public function set_query_bus(BusInterface $bus): void
    {
        $this->query_bus = $bus;
    }
}