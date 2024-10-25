<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes;

use LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\Query\Query;
use LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\Query\QueryHandler;
use LaunchpadCore\Container\AbstractServiceProvider;

class QueryServiceProvider extends AbstractServiceProvider
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Query::class, null, QueryHandler::class);
    }
}