<?php

namespace LaunchpadFrameworkOptions;


use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\HasInflectorInterface;
use LaunchpadCore\Container\InflectorServiceProviderTrait;
use LaunchpadFrameworkOptions\Interfaces\OptionsAwareInterface;
use LaunchpadFrameworkOptions\Interfaces\SettingsAwareInterface;
use LaunchpadFrameworkOptions\Interfaces\TransientsAwareInterface;
use LaunchpadOptions\Interfaces\OptionsInterface;
use LaunchpadOptions\Interfaces\SettingsInterface;
use LaunchpadOptions\Interfaces\TransientsInterface;
use LaunchpadOptions\Options;
use LaunchpadOptions\Settings;
use LaunchpadOptions\Transients;
use League\Container\Definition\DefinitionInterface;

class ServiceProvider extends AbstractServiceProvider implements HasInflectorInterface
{
    use InflectorServiceProviderTrait;

    protected function define()
    {
        $this->register_service(OptionsInterface::class)
            ->share()
            ->set_concrete(Options::class)
            ->set_definition(function (DefinitionInterface $definition) {
            $definition->addArgument('prefix');
        });

        $this->register_service(TransientsInterface::class)
            ->share()
            ->set_concrete(Transients::class)
            ->set_definition(function (DefinitionInterface $definition) {
            $definition->addArgument('prefix');
        });

        $this->register_service(SettingsInterface::class)
            ->share()
            ->set_concrete(Settings::class)
            ->set_definition(function (DefinitionInterface $definition) {
            $prefix = $this->container->get('prefix');
            $definition->addArguments([OptionsInterface::class, "{$prefix}settings"]);
        });
    }

    /**
     * Returns inflectors.
     *
     * @return array[]
     */
    public function get_inflectors(): array
    {
        return [
            OptionsAwareInterface::class => [
                'method' => 'set_options',
                'args' => [
                    OptionsInterface::class,
                ],
            ],
            TransientsAwareInterface::class => [
                'method' => 'set_transients',
                'args' => [
                    TransientsInterface::class,
                ],
            ],
            SettingsAwareInterface::class => [
                'method' => 'set_settings',
                'args' => [
                    SettingsInterface::class,
                ],
            ],
        ];
    }
}