<?php

namespace LaunchpadBuild\Services;

use LaunchpadBuild\Entities\Version;
use League\Flysystem\Filesystem;
use PhpZip\ZipFile;

class FilesManager
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

    public function copy(string $folder, string $destination, array $exclusions = []) {
        foreach ($this->filesystem->listContents($folder) as $content) {
            if($this->is_excluded($content['path'], $exclusions)) {
                continue;
            }
            if($content['type'] === 'dir') {
                $path = $destination . DIRECTORY_SEPARATOR . $content['path'];
                $this->filesystem->createDir($path);
                $this->copy($content['path'], $destination);
                continue;
            }
            $this->filesystem->copy($content['path'], $destination . DIRECTORY_SEPARATOR . $content['path']);
        }
    }

    protected function is_excluded(string $path, array $exclusions = []): bool {
        if(in_array($path, $exclusions)) {
            return true;
        }
        foreach ($exclusions as $exclusion) {
            if(preg_match("/^$exclusion/", $path)) {
                return true;
            }
        }
        return false;
    }

    public function remove(string $node) {
        if(! $this->filesystem->has($node)) {
            return;
        }
        $data = $this->filesystem->getMetadata($node);
        if($data['type'] === 'dir') {
            $this->filesystem->deleteDir($node);
            return;
        }
        $this->filesystem->delete($node);
    }

    public function clean_folder(string $folder) {
        foreach ($this->filesystem->listContents($folder) as $content) {
            $this->remove($content['path']);
        }
    }

    public function generate_zip(string $plugin_directory, string $build_directory, string $plugin_name, Version $version = null)
    {
        $version = is_null($version) ? '1.0.0' : $version->get_value();
        $zipFile = new ZipFile();
        $zipFile->addDirRecursive($plugin_directory);
        $content = $zipFile->outputAsString();
        $this->filesystem->write($build_directory . DIRECTORY_SEPARATOR . $plugin_name . '_' . $version . '.zip', $content);
    }
}
