<?php

namespace LaunchpadFrameworkConstants\Interfaces;

use LaunchpadConstants\PrefixedConstantsInterface;

interface PrefixedConstantsAwareInterface
{
    /**
     * Setup prefixed constants facade.
     *
     * @param PrefixedConstantsInterface $prefixed_constants Prefixed constants facade.
     *
     * @return void
     */
    public function set_prefixed_constants(PrefixedConstantsInterface $prefixed_constants);
}