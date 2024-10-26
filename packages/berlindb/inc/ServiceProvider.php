<?php

namespace LaunchpadBerlinDB;

use LaunchpadBerlinDB\Entities\FileTypeFactory;
use LaunchpadBerlinDB\Services\FieldManager;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use LaunchpadCLI\Services\ClassGenerator;
use LaunchpadCLI\Services\ProviderManager;
use LaunchpadCLI\Templating\Renderer;
use LaunchpadBerlinDB\Commands\GenerateTableCommand;
use LaunchpadBerlinDB\Commands\InstallCommand;
use LaunchpadBerlinDB\Services\ProjectManager;
use LaunchpadCLI\Services\ProjectManager as CLIProjectManager;
class ServiceProvider implements ServiceProviderInterface
{

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Configuration from the project.
     *
     * @var Configurations
     */
    protected $configs;

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @var Renderer
     */
    protected $app_renderer;

    /**
     * Instantiate the class.
     *
     * @param Configurations $configs configuration from the project.
     * @param Filesystem $filesystem Interacts with the filesystem.
     * @param string $app_dir base directory from the cli.
     */
    public function __construct(Configurations $configs, Filesystem $filesystem, string $app_dir)
    {
        $this->configs = $configs;
        $this->filesystem = $filesystem;

        $adapter = new Local(
        // Determine root directory
            __DIR__ . '/../'
        );

        // The FilesystemOperator
        $template_filesystem = new Filesystem($adapter);

        $this->renderer = new Renderer($template_filesystem, '/templates/');

        $adapter = new Local(
        // Determine root directory
            $app_dir
        );

        // The FilesystemOperator
        $app_filesystem = new Filesystem($adapter);

        $this->app_renderer = new Renderer($app_filesystem, '/templates/');
    }


    public function attach_commands(App $app): App
    {
        $project_manager = new ProjectManager($this->filesystem);
        $class_generator = new ClassGenerator($this->filesystem, $this->renderer, $this->configs);
        $project_manager_cli = new CLIProjectManager($this->filesystem);
        $field_manager = new FieldManager($this->renderer);
        $file_type_factory = new FileTypeFactory();

        $provider_manager = new ProviderManager($app, $this->filesystem, $class_generator, $this->app_renderer, $project_manager_cli);
        $app->add(new GenerateTableCommand($class_generator, $this->configs, $provider_manager, $project_manager, $field_manager, $file_type_factory));

        return $app;
    }
}
