<?php

namespace LaunchpadUninstaller\Tests\Unit\inc\Uninstall\Uninstall;

use League\Container\Container;
use Mockery;
use LaunchpadUninstaller\Tests\Unit\TestCase;
use LaunchpadUninstaller\Uninstall\Uninstall;

class Test_UninstallPlugin extends TestCase
{
    protected $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = Mockery::mock(Container::class);
    }

    /**
     * @dataProvider configTestData
     */
    public function testDoAsExpected($config, $expected) {
        Uninstall::set_container($this->container);
        Uninstall::set_params($config['params']);
        $providers = [];
        foreach ($config['providers'] as $provider) {
            $providers[]= $provider['provider'];
            $provider['provider']->allows($provider['callbacks']);
        }

        Uninstall::set_providers($providers);

        foreach ($config['uninstallers'] as $uninstaller) {
            $this->container->allows()->get(get_class($uninstaller))->andReturn($uninstaller);
        }

        foreach ($expected['providers'] as $provider) {
            $this->container->expects()->addServiceProvider($provider);
        }

        foreach ($expected['uninstallers'] as $uninstaller) {
            $uninstaller->expects()->uninstall();
        }

        Uninstall::uninstall_plugin();
    }
}
