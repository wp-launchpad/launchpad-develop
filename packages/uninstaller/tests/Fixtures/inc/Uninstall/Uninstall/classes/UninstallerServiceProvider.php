<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\Uninstall\Uninstall\classes;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;

class UninstallerServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface
{

    protected function define()
    {

    }

    public function get_uninstallers(): array
    {
        return [];
    }
}
