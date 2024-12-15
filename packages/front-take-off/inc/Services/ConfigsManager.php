<?php

namespace LaunchpadFrontTakeOff\Services;

use LaunchpadCLI\Entities\Configurations;
use LaunchpadFront\ServiceProvider;
use League\Flysystem\Filesystem;

class ConfigsManager
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var Configurations
     */
    protected $configurations;

    /**
     * @param Filesystem $filesystem
     * @param Configurations $configurations
     */
    public function __construct(Filesystem $filesystem, Configurations $configurations)
    {
        $this->filesystem = $filesystem;
        $this->configurations = $configurations;
    }


    public function set_up_provider() {
        $base_namespace = $this->configurations->getBaseNamespace();
        $providers_path = 'configs/providers.php';

        if ( ! $this->filesystem->has( $providers_path ) ) {
            return;
        }

        $content = $this->filesystem->read( $providers_path );

        if(! preg_match('/(?<array>return\s\[(?<content>(?:[^[\]]+|(?R))*)\]\s*;\s*$)/', $content, $results)) {
            return;
        }

        $result_content = $results['content'];
        $result_content = "\n    \\$base_namespace" . "Dependencies\\" . ServiceProvider::class . "::class," . $result_content;
        $content = str_replace($results['content'], $result_content, $content);

        $this->filesystem->update($providers_path, $content);
    }

}
