<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc;

use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDesactivatorServiceProviderTrait;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderTrait;

class AnnotationUninstallerServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface {

	use HasUninstallerServiceProviderTrait;
	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_uninstaller(AnnotationUninstaller::class);
	}
}