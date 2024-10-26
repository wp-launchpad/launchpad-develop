<?php

namespace LaunchpadBuild\Services;

use Ahc\Cli\Helper\Shell;
use LaunchpadBuild\Entities\Version;
use LaunchpadCLI\Entities\Configurations;
use League\Flysystem\Filesystem;

class ProjectManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Configurations
     */
    protected $configurations;

    const PARAMETERS_PATH = 'configs'. DIRECTORY_SEPARATOR . 'parameters.php';

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem, Configurations $configurations)
    {
        $this->filesystem = $filesystem;
        $this->configurations = $configurations;
    }


    public function get_plugin_name() : string {
        $namespace = $this->configurations->getBaseNamespace();
        if(strlen($namespace) === 0) {
            return '';
        }
        $namespace = rtrim($namespace, '\\');
        $lastNamespaceSegment = substr($namespace, strrpos($namespace, '\\') + 1);

        $words = preg_split('/(?=[A-Z])/', $lastNamespaceSegment, -1, PREG_SPLIT_NO_EMPTY);

        $projectName = $namespace[0] . implode('-', $words);

        return strtolower($projectName);
    }

    public function run_regular_install(string $plugin_directory) {
        $shell = new Shell($this->findComposer() . ' install');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function run_optimised_install(string $plugin_directory) {
        $shell = new Shell($this->findComposer() . ' install --no-scripts --no-dev --ignore-platform-reqs');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function run_remove_installers(string $plugin_directory)
    {
        $shell = new Shell($this->findComposer() . ' remove composer/installers --update-no-dev --no-scripts --ignore-platform-reqs');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function run_optimise_autoload(string $plugin_directory) {
        $shell = new Shell($this->findComposer() . ' dumpautoload -o');
        $shell->setOptions($plugin_directory);
        $shell->execute();
    }

    public function get_version(): string {
        if(! $this->filesystem->has(self::PARAMETERS_PATH)) {
            return '';
        }
        $content = $this->filesystem->read(self::PARAMETERS_PATH);
        if(! preg_match('/[\'"]plugin_version[\'"]\s*=>\s*[\'"](?<version>[.0-9]*)[\'"]/', $content, $match)) {
            return '';
        }
        return $match['version'];
    }

    public function update_version(Version $version = null) {
        $new_version = is_null($version) ? '1.0.0' : $version->get_value();
        if(! $this->filesystem->has(self::PARAMETERS_PATH)) {
            return;
        }

        $content = $this->filesystem->read(self::PARAMETERS_PATH);
        if(! preg_match('/[\'"]plugin_version[\'"]\s*=>\s*[\'"](?<version>[.0-9]*)[\'"]/', $content, $match)) {
            return;
        }
        $version = $match['version'];

        $full_match = $match[0];
        $full_match_new_version = str_replace($version, $new_version, $full_match);
        $content = str_replace($full_match, $full_match_new_version, $content);

        $this->filesystem->update(self::PARAMETERS_PATH, $content);

        $main_file = $this->get_plugin_name() . '.php';

        if(! $this->filesystem->has($main_file)) {
            return;
        }
        $content = $this->filesystem->read($main_file);
        if(! preg_match('/\*\s*Version:\s*(?<version>[.0-9]*)/', $content, $match)) {
            return;
        }
        $version = $match['version'];

        $full_match = $match[0];
        $full_match_new_version = str_replace($version, $new_version, $full_match);
        $content = str_replace($full_match, $full_match_new_version, $content);

        $this->filesystem->update($main_file, $content);
    }


    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        $composerPath = getcwd().'/composer.phar';

        if (file_exists($composerPath)) {
            return '"'.PHP_BINARY.'" '.$composerPath;
        }

        return 'composer';
    }
}
