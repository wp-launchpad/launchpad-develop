<?php

namespace LaunchpadTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadCLI\Templating\Renderer;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\WordPressKey;

class PluginFileManager
{
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
        $file = $old_configurations->get_wordpress_key()->get_value() . '.php';

        $url = $new_configurations->get_url();
        $description = $new_configurations->get_description();
        $author = $new_configurations->get_description();

        $params = [
            'name' => $new_configurations->get_name(),
            'has_url' => ! is_null($url),
            'has_description' => $description !== '',
            'has_author' => $author !== '',
            'translation_key' => $new_configurations->get_translation_key()->get_value(),
        ];

        if($url) {
            $params['url'] = $url->get_value();
        }

        if($description) {
            $params['description'] = $description;
        }

        if($author) {
            $params['author'] = $author;
        }

        $comment = $this->renderer->apply_template('plugin_comment.php.tpl', $params);

        $content = $this->filesystem->read($file);
        $pattern = "/(\/\*\*\s+\*\s+Plugin\s+Name:.*\*\/\s+)/s";
        $new_content = preg_replace($pattern, $comment, $content);

        $this->filesystem->update($file, $new_content);

        $this->filesystem->rename($file, $new_configurations->get_wordpress_key()->get_value() . '.php');
    }
}
