<?php

namespace LaunchpadTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadCLI\Templating\Renderer;
use LaunchpadTakeOff\Entities\ProjectConfigurations;

class ParametersManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Renderer
     */
    protected $renderer;

    const PARAMETER_PATH = 'configs/parameters.php';

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem, Renderer $renderer)
    {
        $this->filesystem = $filesystem;
        $this->renderer = $renderer;
    }

    public function generate(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {
        $content = $this->renderer->apply_template('parameters.php.tpl', [
            'namespace' => $new_configurations->get_namespace()->get_value(),
            'name' => $new_configurations->get_name(),
            'prefix' => $new_configurations->get_hook_prefix()->get_value(),
            'translation_key' => $new_configurations->get_translation_key()->get_value(),
        ]);
        if ($this->filesystem->has(self::PARAMETER_PATH)) {
            $this->filesystem->update(self::PARAMETER_PATH, $content);
            return;
        }
        $this->filesystem->write(self::PARAMETER_PATH, $content);
    }
}
