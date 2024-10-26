<?php

namespace LaunchpadFrameworkConstants\Tests\Integration\inc\files;

use LaunchpadFrameworkConstants\Interfaces\ConstantsAwareInterface;
use LaunchpadFrameworkConstants\Interfaces\PrefixedConstantsAwareInterface;
use LaunchpadFrameworkConstants\Traits\ConstantsAwareTrait;
use LaunchpadFrameworkConstants\Traits\PrefixedConstantsAwareTrait;

class Subscriber implements ConstantsAwareInterface, PrefixedConstantsAwareInterface
{
    use ConstantsAwareTrait, PrefixedConstantsAwareTrait;

    /**
     * @hook test
     */
    public function test() {
        $this->constants->has('test');
        $this->prefixed_constants->has('test');
    }
}