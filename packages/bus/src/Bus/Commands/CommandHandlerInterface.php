<?php

namespace LaunchpadBus\Bus\Commands;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}