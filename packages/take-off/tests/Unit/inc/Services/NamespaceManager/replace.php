<?php

namespace LaunchpadTakeOff\Tests\Unit\inc\Services\NamespaceManager;

use League\Flysystem\Filesystem;
use Mockery;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\Services\NamespaceManager;
use LaunchpadTakeOff\Tests\Unit\TestCase;

class Test_Replace extends TestCase
{
    protected $filesystem;
    protected $namespace_manager;

    protected $old_config;
    protected $new_config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->filesystem = Mockery::mock(Filesystem::class);
        $this->new_config = Mockery::mock(ProjectConfigurations::class);
        $this->old_config = Mockery::mock(ProjectConfigurations::class);
        $this->namespace_manager = new NamespaceManager($this->filesystem);
    }

    /**
     * @dataProvider configTestData
     */
    public function testTestDoAsExpected($config, $expected) {
           $this->old_config->shouldReceive('get_namespace')->andReturn($config['old_namespace'])->atLeast()->once();
           $this->old_config->shouldReceive('get_test_namespace')->andReturn($config['old_test_namespace'])->atLeast()->once();
           $this->old_config->expects()->get_code_folder()->andReturn($config['old_code_folder']);
           $this->old_config->expects()->get_test_folder()->andReturn($config['old_test_folder']);
           $this->old_config->expects()->get_wordpress_key()->andReturn($config['old_wordpress_key']);
           $this->new_config->expects()->get_wordpress_key()->andReturn($config['new_wordpress_key']);
           $this->new_config->shouldReceive('get_namespace')->andReturn($config['new_namespace'])->atLeast()->once();
           $this->new_config->shouldReceive('get_test_namespace')->andReturn($config['new_test_namespace'])->atLeast()->once();

           $this->filesystem->shouldReceive('listContents')->with($expected['old_code_folder_path'], true)->andReturn($config['files'])->atLeast()->times(1);
           $this->filesystem->shouldReceive('listContents')->with($expected['old_test_folder_path'], true)->andReturn($config['files']);

           foreach ($expected['files'] as $file) {
               $this->filesystem->expects()->has($file['path'])->andReturn($file['has']);
               if(! $file['has']) {
				   continue;
			   }
			   $this->filesystem->expects()->read($file['path'])->andReturn($config['files_content'][$file['path']]);
               $this->filesystem->expects()->update($file['path'], $file['content']);
           }

           $this->namespace_manager->replace($this->old_config, $this->new_config);
    }
}
