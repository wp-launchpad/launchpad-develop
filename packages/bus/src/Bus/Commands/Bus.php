<?php

namespace LaunchpadBus\Bus\Commands;


use League\Tactician\CommandBus;

class Bus extends CommandBus implements BusInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function handle($command) {
        return parent::handle($command);
    }

}