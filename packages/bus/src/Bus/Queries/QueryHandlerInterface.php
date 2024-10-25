<?php

namespace LaunchpadBus\Bus\Queries;

interface QueryHandlerInterface
{
    public function handle(QueryInterface $query): QueryResultInterface;
}