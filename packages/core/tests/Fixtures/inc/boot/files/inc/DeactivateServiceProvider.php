<?php

namespace LaunchpadCore\Tests\Fixtures\inc\boot\files\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use League\Container\Definition\Definition;

class DeactivateServiceProvider extends AbstractServiceProvider implements HasDeactivatorServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Deactivator::class, function (Definition $definition) {
            $definition->addArgument(DeactivateDependency::class);
            $definition->addArgument('key_param');
            $definition->addArgument('cache');
        });
    }

    /**
     * @inheritDoc
     */
    public function get_deactivators(): array
    {
        return [
            Deactivator::class
        ];
    }
}