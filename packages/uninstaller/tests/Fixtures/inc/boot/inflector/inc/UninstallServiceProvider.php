<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use League\Container\Definition\Definition;

class UninstallServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Uninstaller::class, function (Definition $definition) {
            $definition->addArgument(UninstallDependency::class);
        });
    }

    /**
     * @inheritDoc
     */
    public function get_uninstallers(): array
    {
        return [
            Uninstaller::class
        ];
    }
}