<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command;

use LaunchpadBus\Bus\Commands\CommandHandlerInterface;
use LaunchpadBus\Bus\Commands\CommandInterface;

class CommandHandler implements CommandHandlerInterface
{
    protected $called = false;

    public function handle(CommandInterface $command): void
    {
        $this->called = true;
    }

    public function isCalled(): bool
    {
        return $this->called;
    }
}