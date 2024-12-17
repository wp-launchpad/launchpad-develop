<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\files\inc;


class AnnotationUninstaller {
	/**
	 * @uninstall
	 */
	public function update() {
		delete_option('demo_option_2');
	}
}