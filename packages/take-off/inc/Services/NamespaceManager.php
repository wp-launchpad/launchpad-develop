<?php

namespace LaunchpadTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\PS4Namespace;

class NamespaceManager
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
        $code_folder = $old_configurations->get_code_folder();
        $test_folder = $old_configurations->get_test_folder();
        $this->replace_namespace_folder($code_folder, $old_configurations->get_namespace(), $new_configurations->get_namespace());
        $this->replace_namespace_folder($test_folder, $old_configurations->get_test_namespace(), $new_configurations->get_test_namespace());
        $this->replace_namespace_folder($test_folder, $old_configurations->get_namespace(), $new_configurations->get_namespace());

        $files = [
            $old_configurations->get_wordpress_key()->get_value() . '.php',
            $new_configurations->get_wordpress_key()->get_value() . '.php',
            'configs/providers.php',
        ];

        foreach ($files as $file) {
            if(! $this->filesystem->has($file)) {
                continue;
            }
            $content = $this->filesystem->read($file);
            $content = $this->replace_namespace_content($content, $old_configurations->get_namespace(), $new_configurations->get_namespace());
            $this->filesystem->update($file, $content);
        }
    }

    protected function replace_namespace_folder(Folder $folder, PS4Namespace $old_namespace, PS4Namespace $new_namespace) {
        $files = $this->filesystem->listContents($folder->get_value(), true);
        foreach ($files as $file) {
            if($file['type'] !== 'file' || $file['extension'] !== 'php') {
                continue;
            }
            $content = $this->filesystem->read($file['path']);
            $content = $this->replace_namespace_content($content, $old_namespace, $new_namespace);
            $this->filesystem->update($file['path'], $content);
        }
    }

    protected function replace_namespace_content(string $content, PS4Namespace $old_namespace, PS4Namespace $new_namespace) {
        $old_namespace = $old_namespace->get_value();
        $old_namespace_escaped = preg_quote($old_namespace);
        $new_namespace = $new_namespace->get_value();

        $content = preg_replace("/namespace $old_namespace_escaped/", "namespace $new_namespace", $content);
        $content = preg_replace("/use function $old_namespace_escaped/", "use function $new_namespace", $content);
        $content = preg_replace("/\\\\$old_namespace_escaped(\\\\\w+\\\\?)/", "\\\\$new_namespace$1", $content);
        return preg_replace("/use $old_namespace_escaped\\\\/", "use $new_namespace\\\\", $content);
    }
}
