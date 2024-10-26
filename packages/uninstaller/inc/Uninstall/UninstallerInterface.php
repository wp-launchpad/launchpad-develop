<?php

namespace LaunchpadUninstaller\Uninstall;

interface UninstallerInterface
{
    /**
     * Executes this method on plugin uninstall
     *
     * @return void
     */
    public function uninstall();
}
