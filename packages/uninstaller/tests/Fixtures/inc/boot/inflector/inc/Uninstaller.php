<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\PrefixAware;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareTrait;
use LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc\Inflector\Inflected;
use LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc\Inflector\InflectorInterface;
use LaunchpadUninstaller\Uninstall\UninstallerInterface;

class Uninstaller implements UninstallerInterface, PrefixAwareInterface, DispatcherAwareInterface, InflectorInterface
{
    use PrefixAware, DispatcherAwareTrait;

    protected $uninstallDependency;

    /**
     * @var Inflected
     */
    protected $inflected;

    public function __construct(UninstallDependency $uninstallDependency)
    {
        $this->uninstallDependency = $uninstallDependency;
    }

    /**
     * @inheritDoc
     */
    public function uninstall()
    {
        delete_option('demo_option');
        $this->dispatcher->do_action("{$this->prefix}test");
		$this->inflected->method();
    }

    public function inflector_method(Inflected $inflected)
    {
        $this->inflected = $inflected;
    }
}