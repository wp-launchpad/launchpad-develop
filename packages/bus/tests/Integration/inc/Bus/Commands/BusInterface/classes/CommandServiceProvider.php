<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes;

use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command\Command;
use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command\CommandHandler;
use LaunchpadCore\Container\AbstractServiceProvider;

class CommandServiceProvider extends AbstractServiceProvider
{

    protected $provides = [
        Command::class,
    ];

    protected function define()
    {
    }


    public function register()
    {
        $this->getLeagueContainer()->share(Command::class, CommandHandler::class);
    }
}