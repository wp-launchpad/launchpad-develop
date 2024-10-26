<?php

namespace LaunchpadBuild\Commands;

use LaunchpadBuild\Entities\InvalidValue;
use LaunchpadBuild\Entities\Type;
use LaunchpadBuild\Entities\Version;
use LaunchpadBuild\Services\FilesManager;
use LaunchpadBuild\Services\ProjectManager;
use LaunchpadBuild\Steps\StepInterface;
use LaunchpadCLI\Commands\Command;
use LaunchpadCLI\Events\UseHookTrait;
use LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface;
use League\Pipeline\PipelineBuilderInterface;

class BuildArtifactCommand extends Command implements EventDispatcherAwareInterface
{
    use UseHookTrait;
    /**
     * @var FilesManager
     */
    protected $file_manager;

    /**
     * @var ProjectManager
     */
    protected $project_manager;

    /**
     * @var PipelineBuilderInterface
     */
    protected $pipeline_builder;
    /**
     * @var StepInterface[]
     */
    protected $steps;

    /**
     * Instantiate the class.
     *
     * @param FilesManager $file_manager
     * @param ProjectManager $project_manager
     * @param StepInterface[] $steps
     */
    public function __construct(FilesManager $file_manager, ProjectManager $project_manager, PipelineBuilderInterface $pipeline_builder, array $steps)
    {
        parent::__construct('build', 'Build the plugin');

        $this->file_manager = $file_manager;
        $this->project_manager = $project_manager;
        $this->steps = $steps;
        $this->pipeline_builder = $pipeline_builder;

        $this
            ->option('-r --release', 'Version of the plugin')
            ->option('-t --type', 'Type of the build')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 build</end> <comment>--release 1.0.0</end> ## Build the plugin<eol/>'
            );
    }

    /**
     * Execute the command.
     *
     * @param string|null $name Name from the fixture to generate.
     * @return void
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function execute($release, $type)
    {
        $io = $this->app()->io();

        foreach ($this->steps as $step) {
            $step->set_io($io);
        }

        try {
            $type = new Type($type?: Type::PATCH);
        } catch (InvalidValue $e) {
            $io->write('The type value is invalid', true);
        }

        try {
            $old_version = $this->project_manager->get_version();
            $version = new Version($release ?: $old_version);
        } catch (InvalidValue $e) {
            $io->write('The version should be 1.0.1 format', true);
            return;
        }

        if(! $release) {
            $version->increase($type);
        }

        $builder_folder = 'build';
        $plugin_directory = $builder_folder . DIRECTORY_SEPARATOR . $this->project_manager->get_plugin_name();

        $parameters = $this->apply_filter('builder_pipeline_steps', [
            'steps' => $this->steps,
        ]);

        foreach ($parameters['steps'] as $step) {
            $this->pipeline_builder->add($step);
        }
        $pipeline = $this->pipeline_builder->build();

        $payload = $this->apply_filter('builder_pipeline_payload', [
            'builder_folder' => $builder_folder,
            'plugin_directory' => $plugin_directory,
            'plugin_name' => $this->project_manager->get_plugin_name(),
            'version' => $version,
        ]);

        $pipeline->process($payload);
    }
}
