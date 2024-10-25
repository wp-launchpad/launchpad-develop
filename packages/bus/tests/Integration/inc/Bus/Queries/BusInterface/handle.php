<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface;

use LaunchpadBus\Bus\Queries\BusInterface;
use LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\Query\Query;
use LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\Query\QueryResult;
use LaunchpadBus\Tests\Integration\inc\Bus\Queries\BusInterface\classes\QueryServiceProvider;
use LaunchpadBus\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadBus\Bus\Queries\BusInterface::handle
 */
class Test_handle extends TestCase {

    public function testShouldDoAsExpected()
    {
        $this->get_league_container()->addServiceProvider(new QueryServiceProvider());

        $bus = $this->get_container()->get(BusInterface::class);

        $result = $bus->handle(new Query());
        $this->assertInstanceOf(QueryResult::class, $result);
    }
}
