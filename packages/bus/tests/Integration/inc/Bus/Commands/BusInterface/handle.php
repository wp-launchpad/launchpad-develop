<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface;

use LaunchpadBus\Bus\Commands\BusInterface;
use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command\Command;
use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\CommandServiceProvider;
use LaunchpadBus\Tests\Integration\TestCase;

/**
 * @covers \LaunchpadBus\Bus\Commands\BusInterface::handle
 */
class Test_handle extends TestCase {

    public function testShouldDoAsExpected()
    {
        $this->get_league_container()->addServiceProvider(new CommandServiceProvider());

        $bus = $this->get_container()->get(BusInterface::class);

        $bus->handle(new Command());

        $this->assertTrue($this->get_container()->get(Command::class)->isCalled());
    }
}
