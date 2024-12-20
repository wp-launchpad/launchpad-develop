<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Container\Registration\Registration;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDesactivatorServiceProviderTrait;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderTrait;
use League\Container\Definition\Definition;

class UninstallServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface
{
    use HasUninstallerServiceProviderTrait;
    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_uninstaller(Uninstall::class)->autowire();
        $this->register_uninstaller(Uninstaller::class)->autowire();
    }
}