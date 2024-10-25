<?php

namespace LaunchpadBus\Tests\Integration;
use ReflectionObject;
use WPLaunchpadPHPUnitWPHooks\MockHooks;
use WPMedia\PHPUnit\Integration\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use MockHooks, UseContainer;

    protected $config;

    protected $prefix;
    protected static $transients = [];

    public static function set_up_before_class()
    {
        parent::set_up_before_class();

        if (!empty(self::$transients)) {
            foreach (array_keys(self::$transients) as $transient) {
                self::$transients[$transient] = get_transient($transient);
            }
        }
    }

    public static function tear_down_after_class()
    {
        parent::tear_down_after_class();

        foreach (self::$transients as $transient => $value) {
            if (!empty($transient)) {
                set_transient($transient, $value);
            } else {
                delete_transient($transient);
            }
        }
    }

    public function set_up()
    {
        parent::set_up();

        if (empty($this->config)) {
            $this->loadTestDataConfig();
        }

        $this->prefix = $this->get_container()->get('prefix');
        $this->mockHooks();
    }

    public function tear_down()
    {
        $this->resetHooks();
        parent::tear_down();
    }

    public function configTestData()
    {
        if (empty($this->config)) {
            $this->loadTestDataConfig();
        }

        return isset($this->config['test_data'])
            ? $this->config['test_data']
            : $this->config;
    }

    protected function loadTestDataConfig()
    {
        $obj = new ReflectionObject($this);
        $filename = $obj->getFileName();

        $this->config = $this->getTestData(dirname($filename), basename($filename, '.php'));
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getCurrentTest(): string
    {
        return $this->getName();
    }
}
