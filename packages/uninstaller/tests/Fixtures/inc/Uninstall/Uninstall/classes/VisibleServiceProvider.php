<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\Uninstall\Uninstall\classes;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadUninstaller\Uninstall\UninstallServiceProviderInterface;

class VisibleServiceProvider extends AbstractServiceProvider implements UninstallServiceProviderInterface
{

    protected function define()
    {

    }
}
