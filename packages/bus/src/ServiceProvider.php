<?php

namespace LaunchpadBus;

use LaunchpadBus\Bus\ContainerLocator;
use LaunchpadBus\Bus\Queries\Bus;
use LaunchpadBus\Bus\Queries\BusInterface;
use LaunchpadBus\Interfaces\CommandBusAwareInterface;
use LaunchpadBus\Interfaces\QueryBusAwareInterface;
use LaunchpadBus\Traits\QueryBusAware;
use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\HasInflectorInterface;
use LaunchpadCore\Container\InflectorServiceProviderTrait;
use League\Container\Definition\Definition;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

class ServiceProvider extends AbstractServiceProvider implements HasInflectorInterface
{

    use InflectorServiceProviderTrait;

    protected function define()
    {
        $handlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new ContainerLocator($this->getContainer()),
            new HandleInflector()
        );

        $this->register_service(BusInterface::class, function (Definition $definition) use ($handlerMiddleware) {
            $definition->addArgument([$handlerMiddleware]);
        }, Bus::class);

        $this->register_service(\LaunchpadBus\Bus\Commands\BusInterface::class, function (Definition $definition) use ($handlerMiddleware) {
            $definition->addArgument([$handlerMiddleware]);
        }, \LaunchpadBus\Bus\Commands\Bus::class);

    }

    /**
     * Returns inflectors.
     *
     * @return array[]
     */
    public function get_inflectors(): array
    {
        return [
            CommandBusAwareInterface::class => [
                'method' => 'set_command_bus',
                'args' => [
                    \LaunchpadBus\Bus\Commands\BusInterface::class,
                ],
            ],
            QueryBusAwareInterface::class => [
                'method' => 'set_query_bus',
                'args' => [
                    BusInterface::class,
                ],
            ],
        ];
    }
}