<?php

namespace LaunchpadTakeOff\Services;

use Composer\Command\InstallCommand;
use Composer\EventDispatcher\ScriptExecutionException;
use Composer\IO\NullIO;
use League\Flysystem\Filesystem;
use LaunchpadTakeOff\Entities\ProjectConfigurations;
use LaunchpadTakeOff\ServiceProvider;
use Composer\Factory;
use Composer\Json\JsonFile;
use Composer\Composer;
use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

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

    public function adapt(ProjectConfigurations $old_configurations, ProjectConfigurations $new_configurations) {

        $old_namespace = $old_configurations->get_namespace()->get_value() . '\\';
        $new_namespace = $new_configurations->get_namespace()->get_value() . '\\';

        $old_test_namespace = $old_configurations->get_test_namespace()->get_value() . '\\';
        $new_test_namespace = $new_configurations->get_test_namespace()->get_value() . '\\';

        $content = $this->filesystem->read(self::PROJECT_FILE);

        $json = json_decode($content, true);

        if( ! $json) {
            return;
        }

        if( key_exists('type', $json)) {
            $json['type'] = 'wordpress-plugin';
        }

        if (key_exists('extra', $json) && key_exists('mozart', $json['extra']) && key_exists('dep_namespace', $json['extra']['mozart'])) {
            $json['extra']['mozart']['dep_namespace'] = $new_configurations->get_namespace()->get_value() . '\\Dependencies\\';
        }

        if (key_exists('extra', $json) && key_exists('strauss', $json['extra']) && key_exists('namespace_prefix', $json['extra']['strauss'])) {
            $json['extra']['strauss']['namespace_prefix'] = $new_configurations->get_namespace()->get_value() . '\\Dependencies\\';
        }

        if(key_exists('extra', $json) && key_exists('mozart', $json['extra']) && key_exists('classmap_prefix', $json['extra']['mozart'])) {
            $json['extra']['mozart']['classmap_prefix'] = $new_configurations->get_namespace()->get_value();
        }

        if(key_exists('extra', $json) && key_exists('strauss', $json['extra']) && key_exists('classmap_prefix', $json['extra']['strauss'])) {
            $json['extra']['strauss']['classmap_prefix'] = $new_configurations->get_namespace()->get_value();
        }


        if(key_exists('extra', $json) && key_exists('strauss', $json['extra']) && key_exists('constant_prefix', $json['extra']['strauss'])) {
            $json['extra']['strauss']['constant_prefix'] = $new_configurations->get_constant_prefix()->get_value();
        }

        if(key_exists('autoload', $json) && key_exists('psr-4', $json['autoload']) && key_exists($old_namespace, $json['autoload']['psr-4'])) {
            $json['autoload']['psr-4'][$new_namespace] = $json['autoload']['psr-4'][$old_namespace];
            unset($json['autoload']['psr-4'][$old_namespace]);
        }

        if(key_exists('autoload-dev', $json) && key_exists('psr-4', $json['autoload-dev']) && key_exists($old_test_namespace, $json['autoload-dev']['psr-4'])) {
            $json['autoload-dev']['psr-4'][$new_test_namespace] = $json['autoload-dev']['psr-4'][$old_test_namespace];
            unset($json['autoload-dev']['psr-4'][$old_test_namespace]);
        }

        $content = json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) . "\n";

        $this->filesystem->update(self::PROJECT_FILE, $content);
    }

    public function reload() {

        if(defined('WPMEDIA_IS_TESTING')) {
            return;
        }

        $straussApp = new StraussApplication();

        $this->filesystem->deleteDir('inc/Dependencies');
        $this->filesystem->deleteDir('vendor-prefixed');
        $this->filesystem->delete('composer.lock');

        $jsonFile = $this->filesystem->getAdapter()->getPathPrefix() . 'composer.json';

        $composer = Factory::create(new NullIO(), $jsonFile);
        $command = new InstallCommand();
        $command->setComposer($composer);
        $arguments = array(
            '--no-scripts' => true,
        );
        $command->addOption('no-plugins');
        $command->addOption('no-scripts');
        $input = new ArrayInput($arguments);
        $output = new BufferedOutput();
        try {
            $command->run($input, $output);
        } catch (ScriptExecutionException $e) {

        }

        $straussApp->strauss();
    }

    public function cleanup() {
        $content = $this->filesystem->read(self::BUILDER_FILE);

        $content = preg_replace('/\n *\\\\' . preg_quote(ServiceProvider::class) . '::class,\n/', '', $content);

        $this->filesystem->update(self::BUILDER_FILE, $content);

        $content = $this->filesystem->read(self::PROJECT_FILE);

        $json = json_decode($content, true);

        if(key_exists('require-dev', $json) && key_exists('crochetfeve0251/rocket-launcher-take-off', $json['require-dev'])) {
            unset($json['require-dev']['crochetfeve0251/rocket-launcher-take-off']);
        }

        if(key_exists('require-dev', $json) && key_exists('wp-launchpad/take-off', $json['require-dev'])) {
            unset($json['require-dev']['wp-launchpad/take-off']);
        }

        $content = json_encode($json, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) . "\n";

        $this->filesystem->update(self::PROJECT_FILE, $content);
    }
}
