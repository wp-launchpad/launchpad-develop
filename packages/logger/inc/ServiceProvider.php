<?php

namespace LaunchpadLogger;

use League\Container\Definition\DefinitionInterface;
use RocketLauncherCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    protected function define()
    {
        $this->register_service(MonologHandler::class, function (DefinitionInterface $definition) {
            $definition->addArgument($this->getContainer()->get('logger_name'));
            $definition->addArgument($this->getContainer()->get('log_file_name'));
            $definition->addArgument($this->getContainer()->get('log_path'));
            $definition->addArgument($this->getContainer()->get('log_debug_interval'));
        });

        $this->register_service(Logger::class, function (DefinitionInterface $definition) {
            $handlers = [];
            foreach ($this->getContainer()->get('log_handlers') as $handler) {
                $handlers[] = $this->getContainer()->get($handler);
            }
            $definition->addArgument($handlers);
            $definition->addArgument($this->getContainer()->get('log_enabled'));
        });
    }
}
