<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\FilesManager;
use LaunchpadCLI\Events\UseHookTrait;
use LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface;

class CleanDevelopAssets extends AbstractStep implements EventDispatcherAwareInterface
{
    use UseHookTrait;

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
        return 'Start delete develop resources';
    }

    protected function get_ending_message(): string
    {
        return 'End delete develop resources';
    }

    protected function process($payload)
    {

        if(! is_array($payload) || ! key_exists('plugin_directory', $payload)) {
            return;
        }

        $plugin_directory = $payload['plugin_directory'];

        $parameters = $this->apply_filter('builder_remove_files', [
            'files' => [
                $plugin_directory . DIRECTORY_SEPARATOR . 'composer.lock',
                $plugin_directory . DIRECTORY_SEPARATOR . 'vendor'
            ],
            'root_dir' => $plugin_directory
        ]);
        foreach ($parameters['files'] as $file) {
            $this->file_manager->remove($file);
        }
    }

    public function get_id(): string
    {
        return 'clean_develop_assets';
    }
}