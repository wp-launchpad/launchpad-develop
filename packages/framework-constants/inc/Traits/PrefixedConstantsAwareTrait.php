<?php

namespace LaunchpadFrameworkConstants\Traits;

use LaunchpadConstants\PrefixedConstantsInterface;

trait PrefixedConstantsAwareTrait
{
    /**
     * Prefixed constants facade.
     *
     * @var PrefixedConstantsInterface
     */
    protected $prefixed_constants;

    /**
     * Setup prefixed constants facade.
     *
     * @param PrefixedConstantsInterface $prefixed_constants Prefixed constants facade.
     *
     * @return void
     */
    public function set_prefixed_constants( PrefixedConstantsInterface $prefixed_constants)
    {
        $this->prefixed_constants = $prefixed_constants;
    }
}