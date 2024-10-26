<?php
namespace PSR2Plugin\Domains\QueryHandlers;

use PSR2Plugin\LaunchpadBus\Bus\Queries\QueryHandlerInterface;
use PSR2Plugin\Domains\MyQuery;
use PSR2Plugin\Domains\QueryResults\MyQueryResult;
class MyQueryHandler implements QueryHandlerInterface {
    public function handle(MyQuery $query): MyQueryResult
    {
        return new MyQueryResult();
    }
}