<?php

namespace LaunchpadUninstaller\Tests\Fixtures\inc\boot\inflector\inc\Inflector;

class Inflected
{
    public function method()
    {
		delete_option('demo_option_2');
	}
}