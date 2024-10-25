<?php

namespace LaunchpadBuild;

use Ahc\Cli\Helper\Shell;
use LaunchpadBuild\Commands\BuildArtifactCommand;
use LaunchpadBuild\Services\FilesManager;
use LaunchpadBuild\Services\ProjectManager;
use LaunchpadBuild\Steps\CleanDevelopAssets;
use LaunchpadBuild\Steps\CleanFolder;
use LaunchpadBuild\Steps\CopyAssets;
use LaunchpadBuild\Steps\DependenciesInstallation;
use LaunchpadBuild\Steps\OptimizePlugin;
use LaunchpadBuild\Steps\UpdateVersion;
use LaunchpadBuild\Steps\ZipArtifact;
use LaunchpadCLI\App;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface;
use LaunchpadCLI\ServiceProviders\EventDispatcherAwareTrait;
use LaunchpadCLI\ServiceProviders\ServiceProviderInterface;
use League\Event\EventDispatcher;
use League\Flysystem\Filesystem;
use League\Pipeline\PipelineBuilder;

class ServiceProvider implements ServiceProviderInterface, EventDispatcherAwareInterface
{
    use EventDispatcherAwareTrait;
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
        $project_manager = new ProjectManager($this->filesystem, $this->configs);
        $files_manager = new FilesManager($this->filesystem);
        $steps = $this->create_steps($project_manager, $files_manager);
        $pipeline_builder = new PipelineBuilder();
        $command = new BuildArtifactCommand($files_manager, $project_manager, $pipeline_builder, $steps);
        $command->set_event_dispatcher(new EventDispatcher());
        $app->add($command);
        return $app;
    }

    protected function create_steps(ProjectManager $project_manager, FilesManager $files_manager) {
        $steps = [];

        $steps []= new CleanFolder($files_manager);
        $copy_assets_step = new CopyAssets($files_manager);
        $copy_assets_step->set_event_dispatcher($this->event_dispatcher);
        $steps []= $copy_assets_step;
        $steps []= new UpdateVersion($project_manager);
        $steps []= new DependenciesInstallation($project_manager);
        $clean_develop_assets_step = new CleanDevelopAssets($files_manager);
        $clean_develop_assets_step->set_event_dispatcher($this->event_dispatcher);
        $steps []= $clean_develop_assets_step;
        $steps []= new OptimizePlugin($project_manager);
        $steps []= new ZipArtifact($files_manager);

        return $steps;
    }
}
