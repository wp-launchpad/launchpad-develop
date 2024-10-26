<?php

namespace LaunchpadBusTakeOff;


use LaunchpadBusTakeOff\Commands\InstallCommand;
use LaunchpadBusTakeOff\Commands\MakeCommandCommand;
use LaunchpadBusTakeOff\Commands\MakeQueryCommand;
use LaunchpadBusTakeOff\Services\ConfigsManager;
use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use LaunchpadCLI\Services\ClassGenerator;
use LaunchpadCLI\Templating\Renderer;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class ServiceProvider implements ServiceProviderInterface
{

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $app_filesystem;


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
        $this->app_filesystem = new Filesystem($adapter);

        $this->renderer = new Renderer($this->app_filesystem, '/templates/');


    }

    public function attach_commands(App $app): App
    {
        $class_generator = new ClassGenerator($this->filesystem, $this->renderer, $this->configs);

        $configs_manager = new ConfigsManager($this->filesystem, $this->configs);

        if( ! $configs_manager->has_provider()) {
            $app->add(new InstallCommand($configs_manager));
        }

        $app->add(new MakeQueryCommand($class_generator, $this->filesystem, $this->configs));
        $app->add(new MakeCommandCommand($class_generator, $this->filesystem, $this->configs));

        return $app;
    }
}