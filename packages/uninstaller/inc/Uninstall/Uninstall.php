<?php
namespace LaunchpadUninstaller\Uninstall;

use LaunchpadCore\Container\HasInflectorInterface;
use Psr\Container\ContainerInterface;

class Uninstall
{
    protected static $providers = [];

    protected static $params = [];

    protected static $container;

    public static function set_providers(array $providers) {
        self::$providers = $providers;
    }

    public static function set_params(array $params) {
        self::$params = $params;
    }

    public static function set_container(ContainerInterface $container) {
        self::$container = $container;
    }

    public static function uninstall_plugin() {
        foreach (self::$params as $key => $value) {
            self::$container->add( $key, $value);
        }
        $providers = array_filter(self::$providers, function ($provider) {
            if(is_string($provider)) {
                $provider = new $provider();
            }

            if(! $provider instanceof UninstallServiceProviderInterface) {
                return false;
            }

            return $provider;
        });

        $providers = array_map(function ($provider) {
            if(is_string($provider)) {
                return new $provider();
            }
            return $provider;
        }, $providers);

        foreach ($providers as $provider) {
            self::$container->addServiceProvider($provider);
        }

        foreach ( $providers as $service_provider ) {
            if( ! $service_provider instanceof HasInflectorInterface ) {
                continue;
            }
            $service_provider->register_inflectors();
        }

        foreach ($providers as $provider) {
            if(! $provider instanceof HasUninstallerServiceProviderInterface) {
                continue;
            }

            foreach ( $provider->get_uninstallers() as $uninstaller ) {
                $uninstaller_instance = self::$container->get( $uninstaller );
                if(! $uninstaller_instance instanceof UninstallerInterface) {
                    continue;
                }
                $uninstaller_instance->uninstall();
            }
        }
    }
}
