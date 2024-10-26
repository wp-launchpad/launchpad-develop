<?php

namespace LaunchpadUninstaller\Uninstall;

interface HasUninstallerServiceProviderInterface extends UninstallServiceProviderInterface
{
    /**
     * @return string[]
     */
    public function get_uninstallers(): array;
}
