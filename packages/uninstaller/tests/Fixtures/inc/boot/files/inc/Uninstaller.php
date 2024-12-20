<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\files\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use LaunchpadUninstaller\Uninstall\UninstallerInterface;

class Uninstaller implements UninstallerInterface, PrefixAwareInterface, DispatcherAwareInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $deactivateDependency;

    protected $key;

    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(UninstallDependency $deactivateDependency, $key, $cache)
    {
        $this->deactivateDependency = $deactivateDependency;
        $this->key = $key;
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     */
    public function uninstall()
    {
        delete_option('demo_option');
        $this->dispatcher->do_action("{$this->prefix}test");
        $this->cache->clean();
    }
}