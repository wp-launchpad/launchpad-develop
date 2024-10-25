<?php

namespace LaunchpadTakeOff\Commands;

use Ahc\Cli\IO\Interactor;
use LaunchpadCLI\Commands\Command;
use LaunchpadCLI\Entities\Configurations;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\InvalidValue;
use LaunchpadTakeOff\ObjectValues\URL;
use LaunchpadTakeOff\ObjectValues\Version;
use LaunchpadTakeOff\Services\LinterManager;
use LaunchpadTakeOff\Services\NamespaceManager;
use LaunchpadTakeOff\Services\ParametersManager;
use LaunchpadTakeOff\Services\PluginFileManager;
use LaunchpadTakeOff\Services\PrefixManager;
use LaunchpadTakeOff\Services\ProjectManager;

class InitializeProjectCommand extends Command
{

    /**
     * @var Configurations
     */
    protected $configurations;

    /**
     * @var NamespaceManager
     */
    protected $namespace_manager;

    /**
     * @var PluginFileManager
     */
    protected $plugin_file_manager;

    /**
     * @var PrefixManager
     */
    protected $prefix_manager;

    /**
     * @var ProjectManager
     */
    protected $project_manager;

    /**
     * @var LinterManager
     */
    protected $linter_manager;

    /**
     * @var ParametersManager
     */
    protected $parameter_manager;

    public function __construct(Configurations $configurations, NamespaceManager $namespace_manager, PluginFileManager $plugin_file_manager, PrefixManager $prefix_manager, ProjectManager $project_manager, LinterManager $linter_manager, ParametersManager $parameter_manager)
    {
        parent::__construct('initialize', 'Initialize the project');

        $this->configurations = $configurations;
        $this->namespace_manager = $namespace_manager;
        $this->plugin_file_manager = $plugin_file_manager;
        $this->prefix_manager = $prefix_manager;
        $this->project_manager = $project_manager;
        $this->linter_manager = $linter_manager;
        $this->parameter_manager = $parameter_manager;

        $this
            ->option('-n --name', 'Name from the project')
            ->option('-d --description', 'Description from the project')
            ->option('-a --author', 'Author from the project')
            ->option('-u --url', 'URL from the project')
            ->option('-p --php', 'Min PHP version from the project')
            ->option('-w --wp', 'Min WordPress version from the project')
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 initialize</end> ## Initialize the project<eol/>' .
                '<bold>  $0 initialize</end> <comment>-n "My app" -d "My test app" -a Cyrille -u http://example.org -p 7.2 -w 6.0.1 </end> ## Initialize the project<eol/>'
            );
    }

    /**
     * Interacts with the user to get missing values.
     *
     * @param Interactor $io Interface to interact with the user.
     * @return void
     */
    public function interact(Interactor $io)
    {
        // Collect missing opts/args
        if (!$this->name) {
            $this->set('name', $io->prompt('Enter name from the project'));
        }
    }

    public function execute($name, $description, $author, $url, $php, $wp)
    {
        $io = $this->app()->io();

        $name =  trim($name, "'\"");

        $description = is_string($description) ? $description : '';
        $description =  trim($description, "'\"");

        $author = is_string($author) ? $author : '';
        $author =  trim($author, "'\"");

        if($url) {
            try {
                $url = new URL($url);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        if($php) {
            try {
                $php = new Version($php);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        if($wp) {
            try {
                $wp = new Version($wp);
            } catch (InvalidValue $e) {
                $io->write($e->getMessage());
                return;
            }
        }

        $code_folder = new Folder($this->configurations->getCodeDir());
        $tests_folder = new Folder($this->configurations->getTestDir());

        $new_configurations = new ProjectConfigurations($code_folder, $tests_folder, $name, $description, $author, $url, $php, $wp);
        $old_configurations = new ProjectConfigurations($code_folder, $tests_folder, $this->psr4_namespace_to_project_name($this->configurations->getBaseNamespace()));

        $this->namespace_manager->replace($old_configurations, $new_configurations);

        $this->prefix_manager->replace($old_configurations, $new_configurations);

        $this->project_manager->adapt($old_configurations, $new_configurations);

        $this->plugin_file_manager->generate($old_configurations, $new_configurations);

        $this->linter_manager->generate($old_configurations, $new_configurations);

        $this->parameter_manager->generate($old_configurations, $new_configurations);

        $this->project_manager->cleanup();

        $this->project_manager->reload();
    }

    protected function psr4_namespace_to_project_name(string $psr4_namespace) {
        if(strlen($psr4_namespace) === 0) {
            return '';
        }
        $psr4_namespace = rtrim($psr4_namespace, '\\');
        $lastNamespaceSegment = substr($psr4_namespace, strrpos($psr4_namespace, '\\') + 1);

        $words = preg_split('/(?=[A-Z])/', $lastNamespaceSegment, -1, PREG_SPLIT_NO_EMPTY);

        $projectName = $psr4_namespace[0] . implode(' ', $words);

        return strtolower($projectName);
    }

}
