<?php

namespace LaunchpadBus\Tests\Integration\inc\Interfaces\QueryBusAwareInterface;

use LaunchpadBus\Bus\Queries\BusInterface;
use LaunchpadBus\Tests\Integration\inc\Interfaces\QueryBusAwareInterface\classes\QueryBusAwareClass;
use LaunchpadBus\Tests\Integration\TestCase;
use ReflectionClass;

/**
 * @covers \LaunchpadBus\Interfaces\QueryBusAwareInterface::set_query_bus
 */
class Test_setQueryBus extends TestCase {


    public function testShouldDoAsExpected()
    {
        $this->get_league_container()->add(QueryBusAwareClass::class);
        $class = $this->get_container()->get(QueryBusAwareClass::class);

        $reflectionClass = new ReflectionClass(QueryBusAwareClass::class);
        $dispatcher = $reflectionClass->getProperty('query_bus')->getValue($class);
        $this->assertInstanceOf(BusInterface::class, $dispatcher);
    }
}
