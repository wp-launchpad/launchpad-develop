<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\FilesManager;

class ZipArtifact extends AbstractStep
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
        return 'Start zip artifact';
    }

    protected function get_ending_message(): string
    {
        return 'End zip artifact';
    }

    protected function process($payload)
    {
        if(! is_array($payload) || ! key_exists('plugin_directory', $payload) || ! key_exists('builder_folder', $payload) || ! key_exists('plugin_name', $payload) || ! key_exists('version', $payload)) {
            return;
        }
        $plugin_directory = $payload['plugin_directory'];

        $builder_folder = $payload['builder_folder'];

        $plugin_name = $payload['plugin_name'];

        $version = $payload['version'];

        $this->file_manager->generate_zip($plugin_directory, $builder_folder, $plugin_name, $version);
    }

    public function get_id(): string
    {
        return 'zip_artifact';
    }
}