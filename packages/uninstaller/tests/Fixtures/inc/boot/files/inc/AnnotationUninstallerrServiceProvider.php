<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\files\inc;


use LaunchpadCore\Container\AbstractServiceProvider;
use LaunchpadCore\Deactivation\HasDeactivatorServiceProviderInterface;
use LaunchpadCore\Deactivation\HasDesactivatorServiceProviderTrait;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderInterface;
use LaunchpadUninstaller\Uninstall\HasUninstallerServiceProviderTrait;

class AnnotationUninstallerrServiceProvider extends AbstractServiceProvider implements HasUninstallerServiceProviderInterface {

	use HasUninstallerServiceProviderTrait;
	/**
	 * @inheritDoc
	 */
	protected function define() {
		$this->register_uninstaller(AnnotationUninstaller::class);
	}
}