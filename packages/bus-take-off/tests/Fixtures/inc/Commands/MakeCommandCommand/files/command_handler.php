<?php
namespace PSR2Plugin\Domains;

use PSR2Plugin\LaunchpadBus\Bus\Commands\CommandHandlerInterface;
use PSR2Plugin\Domains\MyCommand;

class MyCommandHandler implements CommandHandlerInterface {
    public function handle(MyCommand $command): void
    {

    }
}