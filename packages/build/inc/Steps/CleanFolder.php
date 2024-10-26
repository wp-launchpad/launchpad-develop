<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\FilesManager;

class CleanFolder extends AbstractStep
{
    /**
     * @var FilesManager
     */
    protected $file_manager;

    /**
     * @param FilesManager $file_manager
     */
    public function __construct(FilesManager $file_manager)
    {
        $this->file_manager = $file_manager;
    }

    protected function get_beginning_message(): string
    {
        return 'Start cleaning build folder';
    }

    protected function get_ending_message(): string
    {
        return 'End cleaning build folder';
    }

    protected function process($payload)
    {

        if(! is_array($payload) || ! key_exists('builder_folder', $payload)) {
            return;
        }

        $builder_folder = $payload['builder_folder'];


        $this->file_manager->clean_folder($builder_folder);
    }

    public function get_id(): string
    {
        return 'clean_folder';
    }
}