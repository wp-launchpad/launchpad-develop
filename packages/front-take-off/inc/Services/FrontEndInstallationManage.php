<?php

namespace LaunchpadFrontTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadFrontTakeOff\ObjectValues\FrontVersion;

class FrontEndInstallationManage
{
    /**
     * @var Filesystem
     */
    protected $project_filesystem;

    /**
     * @var Filesystem
     */
    protected $library_filesystem;

    /**
     * @param Filesystem $project_filesystem
     * @param Filesystem $library_filesystem
     */
    public function __construct(Filesystem $project_filesystem, Filesystem $library_filesystem)
    {
        $this->project_filesystem = $project_filesystem;
        $this->library_filesystem = $library_filesystem;
    }

    public function move_front_assets( FrontVersion $version ) {
        $library_root = 'front' . DIRECTORY_SEPARATOR . $version->getValue();
        $library_root_regex = preg_quote($library_root);
        $project_root = '_dev';
        foreach ($this->library_filesystem->listContents($library_root, true) as $path) {
            $new_path = preg_replace("#^$library_root_regex#", $project_root, $path['path']);
            if($path['type'] === 'file') {
                $content = $this->library_filesystem->read($path['path']);
                $this->project_filesystem->write($new_path, $content);
                continue;
            }

            if($path['type'] === 'dir') {
                $this->project_filesystem->createDir($new_path);
            }
        }
    }

    public function create_template_folder() {
        $template_dir = 'templates';

        $params_path = 'configs/parameters.php';

        if ( $this->project_filesystem->has($template_dir) ) {
            return;
        }

        $this->project_filesystem->createDir($template_dir);

        if ( ! $this->project_filesystem->has( $params_path ) ) {
            return;
        }

        $content = $this->project_filesystem->read( $params_path );

        $content = $this->add_template_param($content);
        $this->project_filesystem->update($params_path, $content);
    }

    protected function add_template_param(string $content) {
        if(preg_match('/[\'"]assets_url[\'"]\s=>/', $content)) {
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
        $new_content = "$indents'template_path' => \$plugin_launcher_path . 'templates/',\n";
        $new_content .= "$indents'assets_url' => plugins_url('assets/', \$plugin_launcher_path . '/' . basename( \$plugin_launcher_path ) . '.php'),\n";
        $new_content .= "];\n";

        return preg_replace('/]\s*;\s*$/', $new_content, $content);
    }
}
