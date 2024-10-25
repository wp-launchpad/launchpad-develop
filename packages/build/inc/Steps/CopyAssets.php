<?php

namespace LaunchpadBuild\Steps;

use LaunchpadBuild\Services\FilesManager;
use LaunchpadCLI\Events\UseHookTrait;
use LaunchpadCLI\ServiceProviders\EventDispatcherAwareInterface;

class CopyAssets extends AbstractStep implements EventDispatcherAwareInterface
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
        return 'Start copying assets';
    }

    protected function get_ending_message(): string
    {
        return 'End copying assets';
    }

    protected function process($payload)
    {
        if(! is_array($payload) || ! key_exists('plugin_directory', $payload)) {
            return;
        }

        $plugin_directory = $payload['plugin_directory'];
        $builder_folder = $payload['builder_folder'];

        $parameters = $this->apply_filter('builder_copy_excluded_files', [
            'files' =>
                [
                    $builder_folder,
                    '.git',
                    '.github',
                    '.idea',
                    'phpcs.xml',
                    'README.MD',
                    '_dev',
                    'tests',
                    'bin',
                    'package.json',
                    'package.lock',
                    'node_modules'
                ]]);
        $this->file_manager->copy('.', $plugin_directory, $parameters['files']);
    }

    public function get_id(): string
    {
        return 'copy_assets';
    }
}