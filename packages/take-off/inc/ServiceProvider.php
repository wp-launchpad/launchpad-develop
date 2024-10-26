<?php

namespace LaunchpadTakeOff;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use LaunchpadCLI\Templating\Renderer;
use LaunchpadTakeOff\Commands\InitializeProjectCommand;
use LaunchpadTakeOff\Services\LinterManager;
use LaunchpadTakeOff\Services\NamespaceManager;
use LaunchpadTakeOff\Services\ParametersManager;
use LaunchpadTakeOff\Services\PluginFileManager;
use LaunchpadTakeOff\Services\PrefixManager;
use LaunchpadTakeOff\Services\ProjectManager;

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
    }


    /**
     * @inheritDoc
     */
    public function attach_commands(App $app): App
    {
        $namespace_manager = new NamespaceManager($this->filesystem);
        $plugin_file_manager = new PluginFileManager($this->filesystem, $this->renderer);
        $prefix_manager = new PrefixManager($this->filesystem);
        $project_manager = new ProjectManager($this->filesystem);
        $linter_manager = new LinterManager($this->filesystem, $this->renderer);
        $parameter_manager = new ParametersManager($this->filesystem, $this->renderer);
        $app->add(new InitializeProjectCommand($this->configs, $namespace_manager, $plugin_file_manager, $prefix_manager, $project_manager, $linter_manager, $parameter_manager));
        return $app;
    }
}
