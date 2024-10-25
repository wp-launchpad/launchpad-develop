<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\Query;

use LaunchpadBus\Bus\Queries\QueryHandlerInterface;
use LaunchpadBus\Bus\Queries\QueryInterface;
use LaunchpadBus\Bus\Queries\QueryResultInterface;

class QueryHandler implements QueryHandlerInterface
{

    public function handle(QueryInterface $query): QueryResultInterface
    {
        return new QueryResult();
    }
}