<?php

namespace LaunchpadBus\Bus;



use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerInterface;

class ContainerLocator implements HandlerLocator
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     *
     * @return object
     *
     * @throws MissingHandlerException
     */
    public function getHandlerForCommand($commandName)
    {
        if (!$this->container->has($commandName)) {
            throw MissingHandlerException::forCommand($commandName);
        }


        return $this->container->get($commandName);
    }
}