<?php

namespace LaunchpadTakeOff\Tests\Unit\inc\Entities;

use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\Tests\Unit\TestCase;

class Test_ProjectConfigurations extends TestCase
{
    /**
     * @dataProvider configTestData
     */
    public function testShouldDoAsExpected($config, $expected) {
        $config = new ProjectConfigurations(
            $config['code_folder'],
            $config['test_folder'],
            $config['name'],
            $config['description'],
            $config['author'],
            $config['url'],
            $config['min_php'],
            $config['min_wp']
        );
        $this->assertSame($expected['name'], $config->get_name());
        $this->assertSame($expected['author'], $config->get_author());
        $this->assertSame($expected['description'], $config->get_description());
        $this->assertEquals($expected['url'], $config->get_url());
        $this->assertEquals($expected['code_folder'], $config->get_code_folder());
        $this->assertEquals($expected['test_folder'], $config->get_test_folder());
        $this->assertEquals($expected['min_php'], $config->get_min_php());
        $this->assertEquals($expected['min_wp'], $config->get_min_wp());
        $this->assertEquals($expected['translation_key'], $config->get_translation_key());
        $this->assertEquals($expected['wordpress_key'], $config->get_wordpress_key());
        $this->assertEquals($expected['constant_prefix'], $config->get_constant_prefix());
        $this->assertEquals($expected['hook_prefix'], $config->get_hook_prefix());
        $this->assertEquals($expected['namespace'], $config->get_namespace());
        $this->assertEquals($expected['test_namespace'], $config->get_test_namespace());
    }
}