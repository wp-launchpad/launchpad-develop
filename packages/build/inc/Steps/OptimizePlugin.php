<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\ProjectManager;

class OptimizePlugin extends AbstractStep
{

    /**
     * @var ProjectManager
     */
    protected $project_manager;

    /**
     * @param ProjectManager $project_manager
     */
    public function __construct(ProjectManager $project_manager)
    {
        $this->project_manager = $project_manager;
    }

    protected function get_beginning_message(): string
    {
        return 'Start optimize plugin';
    }

    protected function get_ending_message(): string
    {
        return 'End optimize plugin';
    }

    protected function process($payload)
    {
        if(! is_array($payload) || ! key_exists('plugin_directory', $payload)) {
            return;
        }

        $plugin_directory = $payload['plugin_directory'];

        $this->project_manager->run_optimised_install($plugin_directory);
        $this->project_manager->run_remove_installers($plugin_directory);
        $this->project_manager->run_optimise_autoload($plugin_directory);
    }

    public function get_id(): string
    {
        return 'optimize_plugin';
    }
}