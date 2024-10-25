<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\ProjectManager;

class DependenciesInstallation extends AbstractStep
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
        return 'Start regular dependencies installation';
    }

    protected function get_ending_message(): string
    {
        return 'End regular dependencies installation';
    }

    protected function process($payload)
    {
        if(! is_array($payload) || ! key_exists('plugin_directory', $payload)) {
            return;
        }

        $plugin_directory = $payload['plugin_directory'];

        $this->project_manager->run_regular_install($plugin_directory);
    }

    public function get_id(): string
    {
        return 'dependencies_installation';
    }
}