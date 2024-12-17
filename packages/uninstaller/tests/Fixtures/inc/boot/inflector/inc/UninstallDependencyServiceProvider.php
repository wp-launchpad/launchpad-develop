<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\DeactivationServiceProviderInterface;
use LaunchpadUninstaller\Uninstall\UninstallServiceProviderInterface;

class UninstallDependencyServiceProvider extends AbstractServiceProvider implements UninstallServiceProviderInterface
{

    protected function define()
    {
        $this->register_service(UninstallDependency::class);
    }
}