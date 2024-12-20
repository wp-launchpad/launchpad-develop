<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\autowiring\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;

class Uninstaller implements PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $uninstallDependency;

    /**
     * @var Cache
     */
    protected $cache;

    protected $key_param;

    public function __construct(UninstallDependency $uninstallDependency, $cache, $key_param)
    {
        $this->uninstallDependency = $uninstallDependency;
        $this->cache               = $cache;
        $this->key_param = $key_param;
    }


    /**
     * @uninstall
     */
    public function method()
    {
        delete_option('demo_option_2');
        $this->dispatcher->do_action("{$this->prefix}test");
        $this->cache->clean();
    }
}