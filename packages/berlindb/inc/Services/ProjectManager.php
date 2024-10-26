<?php

namespace LaunchpadBerlinDB\Services;

use League\Flysystem\Filesystem;

class ProjectManager
{
    CONST COMPOSER_FILE = 'composer.json';

    /**
     * Interacts with the filesystem.
     *
     * @var Filesystem
     */
    protected $filesystem;


    /**
     * Instantiate the class.
     *
     * @param Filesystem $filesystem Interacts with the filesystem.
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function is_resolver_present()
    {
        $content = $this->filesystem->read(self::COMPOSER_FILE);
        $json = json_decode($content,true);
        return $json && key_exists('extra', $json) && key_exists('mozart', $json['extra']) && key_exists('packages', $json['extra']['mozart']) && in_array('wp-launchpad/autoresolver', $json['extra']['mozart']['packages']);
    }
}
