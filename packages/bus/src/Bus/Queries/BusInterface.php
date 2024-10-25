<?php

namespace LaunchpadBus\Bus\Queries;

interface BusInterface
{
    public function handle(QueryInterface $query): QueryResultInterface;
}