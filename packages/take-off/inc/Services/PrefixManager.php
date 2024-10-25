<?php

namespace LaunchpadTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadTakeOff\Entities\ProjectConfigurations;

class PrefixManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function replace(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

        $file = 'tests/Integration/bootstrap.php';
        $content = $this->filesystem->read($file);
        $content = str_replace("require {$old_configurations->get_constant_prefix()->get_value()}PLUGIN_ROOT . '/{$old_configurations->get_wordpress_key()->get_value()}.php';","require {$new_configurations->get_constant_prefix()->get_value()}PLUGIN_ROOT . '/{$new_configurations->get_wordpress_key()->get_value()}.php';", $content);
        $this->filesystem->update($file, $content);

        $files = [
            'tests/Integration/bootstrap.php',
            'tests/Unit/bootstrap.php',
        ];

        foreach ($files as $file) {
            $content = $this->filesystem->read($file);
            $content = $this->replace_prefix_constants($content, $old_configurations->get_constant_prefix()->get_value(), $new_configurations->get_constant_prefix()->get_value());
            $this->filesystem->update($file, $content);
        }
    }

    protected function replace_prefix_constants($content, $prefix, $new_prefix) {
        $pattern = '/\b' . $prefix . '(\w+)\b/';
        return preg_replace($pattern, $new_prefix . '$1', $content);
    }

}
