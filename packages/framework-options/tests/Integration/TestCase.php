<?php

namespace LaunchpadFrameworkOptions\Tests\Integration;

use WPMedia\PHPUnit\Integration\TestCase as BaseTestCase;
use WPLaunchpadPHPUnitWPHooks\MockHooks;

abstract class TestCase extends BaseTestCase
{
    use MockHooks;

    public function set_up()
    {
        parent::set_up();
        $this->mockHooks();
    }

    public function tear_down()
    {
        $this->resetHooks();
        parent::tear_down();
    }

    function getPrefix(): string {
        return 'prefix_';
    }

    function getCurrentTest(): string {
        return $this->getName();
    }
}
