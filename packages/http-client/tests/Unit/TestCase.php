<?php

namespace LaunchpadHTTPClient\Tests\Unit;
use ReflectionObject;
use WPMedia\PHPUnit\Unit\TestCase as UnitTestCase;
use Brain\Monkey;

abstract class TestCase extends UnitTestCase
{
    protected $config;

    protected function setUp(): void
    {
        parent::setUp();

        if (empty($this->config)) {
            $this->loadTestDataConfig();
        }

    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
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
}