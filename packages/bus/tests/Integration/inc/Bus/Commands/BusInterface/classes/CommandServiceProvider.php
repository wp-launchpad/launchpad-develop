<?php

namespace LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes;

use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command\Command;
use LaunchpadBus\Tests\Integration\inc\Bus\Commands\BusInterface\classes\Command\CommandHandler;
use LaunchpadCore\Container\AbstractServiceProvider;

class CommandServiceProvider extends AbstractServiceProvider
{
    protected function define()
    {
		$this->register_service(Command::class)
			 ->set_concrete(CommandHandler::class)
			 ->share();
	}
}