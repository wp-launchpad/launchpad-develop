<?php
namespace {{ base_namespace }};

use {{ root_namespace }}LaunchpadBus\Bus\Commands\CommandHandlerInterface;
use {{ base_namespace }}\{{ name }};

class {{ name }}Handler implements CommandHandlerInterface {
    public function handle({{ name }} $command): void
    {

    }
}