<?php

namespace LaunchpadBus\Bus\Commands;

interface BusInterface
{
    public function handle(CommandInterface $command);
}