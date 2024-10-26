<?php

namespace LaunchpadBusTakeOff\Commands;

use LaunchpadBusTakeOff\Services\ConfigsManager;
use LaunchpadCLI\Commands\Command;

class InstallCommand extends Command
{
    /**
     * @var ConfigsManager
     */
    protected $configs_manager;

    /**
     * Instantiate the class.
     *
     * @param ConfigsManager $configs_manager
     */
    public function __construct(ConfigsManager $configs_manager)
    {
        parent::__construct('bus:install', 'Install a command bus');

        $this->configs_manager = $configs_manager;

        $this
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 bus:install</end> ## Install a command bus<eol/>'
            );
    }

    public function execute() {

        if( $this->configs_manager->has_provider()) {
            return;
        }

        $this->configs_manager->set_up_provider();
    }
}