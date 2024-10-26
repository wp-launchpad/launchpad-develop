<?php

namespace LaunchpadBus\Tests\Integration\inc\Interfaces\QueryBusAwareInterface\classes;

use LaunchpadBus\Interfaces\QueryBusAwareInterface;
use LaunchpadBus\Traits\QueryBusAware;

class QueryBusAwareClass implements QueryBusAwareInterface
{
    use QueryBusAware;
}