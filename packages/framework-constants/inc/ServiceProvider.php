<?php

namespace LaunchpadFrameworkConstants;

use LaunchpadConstants\ConstantsInterface;
use LaunchpadConstants\PrefixedConstantsInterface;
use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\HasInflectorInterface;
use LaunchpadCore\Container\InflectorServiceProviderTrait;
use LaunchpadDispatcher\Dispatcher;
use LaunchpadFrameworkConstants\Facades\DispatcherAwareConstants;
use LaunchpadFrameworkConstants\Facades\DispatcherAwarePrefixedConstants;
use LaunchpadFrameworkConstants\Interfaces\ConstantsAwareInterface;
use LaunchpadFrameworkConstants\Interfaces\PrefixedConstantsAwareInterface;
use League\Container\Definition\DefinitionInterface;

class ServiceProvider extends AbstractServiceProvider implements HasInflectorInterface
{
    use InflectorServiceProviderTrait;

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this
            ->register_service(ConstantsInterface::class)
            ->share()
            ->set_concrete(DispatcherAwareConstants::class)
            ->set_definition(function (DefinitionInterface $definition) {
                $definition->addArgument('dispatcher');
            });

        $this->register_service(PrefixedConstantsInterface::class)
            ->share()
            ->set_concrete(DispatcherAwarePrefixedConstants::class)
            ->set_definition(function (DefinitionInterface $definition) {
                $definition->addArgument('dispatcher');
            });
    }

    /**
     * @inheritDoc
     */
    public function get_inflectors(): array
    {
        return [
            ConstantsAwareInterface::class => [
                'method' => 'set_constants',
                'args' => [
                    ConstantsInterface::class,
                ],
            ],
            PrefixedConstantsAwareInterface::class => [
                'method' => 'set_prefixed_constants',
                'args' => [
                    PrefixedConstantsInterface::class,
                ],
            ],
        ];
    }
}