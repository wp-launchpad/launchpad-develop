<?php

namespace LaunchpadTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadCLI\Templating\Renderer;
use LaunchpadTakeOff\Entities\ProjectConfigurations;

class LinterManager
{
    const LINTER_FILE = 'phpcs.xml';

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @param Filesystem $filesystem
     * @param Renderer $renderer
     */
    public function __construct(Filesystem $filesystem, Renderer $renderer)
    {
        $this->filesystem = $filesystem;
        $this->renderer = $renderer;
    }

    public function generate(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {
            if($this->filesystem->has(self::LINTER_FILE)) {
                return;
            }

            $params = [
                'has_php' => $new_configurations->get_min_php() !== null,
                'has_wp' => $new_configurations->get_min_wp() !== null,
                'translation_key' => $new_configurations->get_translation_key()->get_value(),
                'hook_prefix' => $new_configurations->get_hook_prefix()->get_value(),
                'namespace' => $new_configurations->get_namespace()->get_value(),
            ];

            if($new_configurations->get_min_php() !== null) {
                $params['php'] = $new_configurations->get_min_php()->get_value();
            }

            if($new_configurations->get_min_wp() !== null) {
                $params['wp'] = $new_configurations->get_min_wp()->get_value();
            }

            $content = $this->renderer->apply_template('phpcs.xml.tpl', $params);

            $this->filesystem->write(self::LINTER_FILE, $content);
    }
}
