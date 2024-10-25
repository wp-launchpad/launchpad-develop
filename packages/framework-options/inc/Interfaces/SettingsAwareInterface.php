<?php

namespace LaunchpadFrameworkOptions\Interfaces;

use LaunchpadOptions\Interfaces\SettingsInterface;

interface SettingsAwareInterface
{
    /**
     * Set settings facade.
     *
     * @param SettingsInterface $settings Settings facade.
     * @return void
     */
    public function set_settings(SettingsInterface $settings);
}