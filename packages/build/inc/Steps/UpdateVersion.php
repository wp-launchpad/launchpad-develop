<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\ProjectManager;

class UpdateVersion extends AbstractStep
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
        return 'Start updating version';
    }

    protected function get_ending_message(): string
    {
        return 'End updating version';
    }

    protected function process($payload)
    {
        if(! is_array($payload) || ! key_exists('version', $payload)) {
            return;
        }

        $version = $payload['version'];

        $this->project_manager->update_version($version);
    }

    public function get_id(): string
    {
        return 'update_version';
    }
}