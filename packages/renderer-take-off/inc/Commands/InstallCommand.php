<?php

namespace LaunchpadRendererTakeOff\Commands;

use LaunchpadCLI\Commands\Command;
use LaunchpadRendererTakeOff\Services\ConfigsManager;
use League\Flysystem\Filesystem;

class InstallCommand extends Command
{

    /**
     * @var ConfigsManager
     */
    protected $config_manager;

    /**
     * @var Filesystem
     */
    protected $project_filesystem;

    /**
     * Instantiate the class.
     *
     * @param Filesystem $configs_manager
     */
    public function __construct(Filesystem $project_filesystem, ConfigsManager $config_manager)
    {
        parent::__construct('renderer:install', 'Install a renderer');

        $this->project_filesystem = $project_filesystem;
        $this->config_manager = $config_manager;

        $this
            // Usage examples:
            ->usage(
            // append details or explanation of given example with ` ## ` so they will be uniformly aligned when shown
                '<bold>  $0 renderer:install</end> ## Install a renderer<eol/>'
            );
    }


    public function execute() {

        $this->create_template_folder();
        $this->config_manager->set_up_provider();
    }

    public function create_template_folder() {

        $params_path = 'configs/parameters.php';

        $this->create_template_dir();

        if ( ! $this->project_filesystem->has( $params_path ) ) {
            return;
        }

        $content = $this->project_filesystem->read( $params_path );

        $parameters = [
            'template_path' => '$plugin_launcher_path . \'templates/\'',
            'root_directory' => ' WP_CONTENT_DIR . \'/cache/\'',
            'renderer_cache_enabled' => 'false',
            'renderer_caching_solution' => '[]',
        ];

        foreach ($parameters as $name => $value) {
            $content = $this->add_parameter($content, $name, $value);
        }

        $this->project_filesystem->update($params_path, $content);
    }

    protected function create_template_dir()
    {
        $template_dir = 'templates';
        if ( $this->project_filesystem->has($template_dir) ) {
            return;
        }

        $this->project_filesystem->createDir($template_dir);
    }

    protected function add_parameter(string $content, string $name, string $value)
    {
        if(preg_match('/[\'"]' . $name . '[\'"]\s=>/', $content)) {
            return $content;
        }

        if(! preg_match('/(?<array>return\s\[(?:[^[\]]+|(?R))*\]\s*;\s*$)/', $content, $results)) {
            return $content;
        }

        $array = $results['array'];

        if(! preg_match('/(?<indents>\h*)[\'"].*[\'"]\s=>/', $array, $results)) {
            return $content;
        }

        $indents = $results['indents'];
        $new_content = "$indents'$name' => $value,\n";
        $new_content .= "];\n";

        return preg_replace('/]\s*;\s*$/', $new_content, $content);
    }
}