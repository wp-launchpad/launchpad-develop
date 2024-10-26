<?php
namespace {{ base_namespace }}\QueryHandlers;

use {{ root_namespace }}LaunchpadBus\Bus\Queries\QueryHandlerInterface;
use {{ base_namespace }}\{{ name }};
use {{ base_namespace }}\QueryResults\{{ name }}Result;
class {{ name }}Handler implements QueryHandlerInterface {
    public function handle({{ name }} $query): {{ name }}Result
    {
        return new {{ name }}Result();
    }
}