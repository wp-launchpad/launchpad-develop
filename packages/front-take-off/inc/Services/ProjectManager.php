<?php

namespace LaunchpadFrontTakeOff\Services;

use League\Flysystem\Filesystem;
use LaunchpadFrontTakeOff\ServiceProvider;

class ProjectManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    const PROJECT_FILE = 'composer.json';
    const BUILDER_FILE = 'bin/generator';
    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function cleanup() {
        $content = $this->filesystem->read(self::BUILDER_FILE);

        $content = preg_replace('/\n *\\\\' . preg_quote(ServiceProvider::class) . '::class,\n/', '', $content);

        $this->filesystem->update(self::BUILDER_FILE, $content);

        $content = $this->filesystem->read(self::PROJECT_FILE);

        $json = json_decode($content, true);

        if(key_exists('require-dev', $json) && key_exists('wp-launchpad/front-take-off', $json['require-dev'])) {
            unset($json['require-dev']['wp-launchpad/front-take-off']);
        }

        if(key_exists('require', $json) && key_exists('wp-launchpad/front-take-off', $json['require'])) {
            unset($json['require']['wp-launchpad/front-take-off']);
        }

        $content = json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) . "\n";

        $this->filesystem->update(self::PROJECT_FILE, $content);
    }
}
