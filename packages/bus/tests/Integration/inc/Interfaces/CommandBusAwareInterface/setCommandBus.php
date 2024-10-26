<?php

namespace LaunchpadBus\Tests\Integration\inc\Interfaces\CommandBusAwareInterface;

use LaunchpadBus\Bus\Commands\BusInterface;
use LaunchpadBus\Tests\Integration\inc\Interfaces\CommandBusAwareInterface\classes\CommandBusAwareClass;
use LaunchpadBus\Tests\Integration\TestCase;
use ReflectionClass;

/**
 * @covers \LaunchpadBus\Interfaces\CommandBusAwareInterface::set_command_bus
 */
class Test_setCommandBus extends TestCase {

    public function testShouldDoAsExpected()
    {
        $this->get_league_container()->add(CommandBusAwareClass::class);
        $class = $this->get_container()->get(CommandBusAwareClass::class);

        $reflectionClass = new ReflectionClass(CommandBusAwareClass::class);
        $dispatcher = $reflectionClass->getProperty('command_bus')->getValue($class);
        $this->assertInstanceOf(BusInterface::class, $dispatcher);
    }
}
