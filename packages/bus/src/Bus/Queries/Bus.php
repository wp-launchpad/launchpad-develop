<?php

namespace LaunchpadBus\Bus\Queries;

use LaunchpadBus\Bus\Queries\BusInterface;
use League\Tactician\CommandBus;

class Bus extends CommandBus implements BusInterface
{
    /**
     * @param QueryInterface $query
     * @return QueryResultInterface
     */
    public function handle($query): QueryResultInterface {
        return parent::handle($query);
    }

}