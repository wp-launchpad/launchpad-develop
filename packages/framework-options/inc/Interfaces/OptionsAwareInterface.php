<?php

namespace LaunchpadFrameworkOptions\Interfaces;

use LaunchpadOptions\Interfaces\OptionsInterface;

interface OptionsAwareInterface
{
    /**
     * Set options facade.
     *
     * @param OptionsInterface $options Options facade.
     * @return void
     */
    public function set_options(OptionsInterface $options);
}