<?php
namespace LaunchpadRendererTakeOff;

use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use LaunchpadRendererTakeOff\Commands\InstallCommand;
use LaunchpadRendererTakeOff\Services\ConfigsManager;
use League\Flysystem\Filesystem;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Configuration from the project.
     *
     * @var Configurations
     */
    protected $configs;

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;

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
    }


    public function attach_commands(App $app): App
    {
        $config_manager = new ConfigsManager($this->filesystem, $this->configs);
        $app->add(new InstallCommand($this->filesystem, $config_manager));
        return $app;
    }
}