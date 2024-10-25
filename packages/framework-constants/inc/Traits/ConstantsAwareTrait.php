<?php

namespace LaunchpadFrameworkConstants\Traits;

use LaunchpadConstants\ConstantsInterface;

trait ConstantsAwareTrait
{
    /**
     * Constants facade.
     *
     * @var ConstantsInterface
     */
    protected $constants;

    /**
     * Setup constants facade.
     *
     * @param ConstantsInterface $constants Constants facade.
     *
     * @return void
     */
    public function set_constants( ConstantsInterface $constants)
    {
        $this->constants = $constants;
    }
}