<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc;


class AnnotationActivator {

	/**
	 * @activate
	 */
	public function update() {
		update_option('demo_option_2', true);
	}
}