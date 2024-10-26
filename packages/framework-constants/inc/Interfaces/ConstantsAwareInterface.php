<?php

namespace LaunchpadFrameworkConstants\Interfaces;

use LaunchpadConstants\ConstantsInterface;

interface ConstantsAwareInterface
{
    /**
     * Setup constants facade.
     *
     * @param ConstantsInterface $constants Constants facade.
     *
     * @return void
     */
    public function set_constants(ConstantsInterface $constants);
}