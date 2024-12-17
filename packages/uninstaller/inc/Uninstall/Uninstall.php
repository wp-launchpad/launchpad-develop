<?php
namespace LaunchpadUninstaller\Uninstall;

use LaunchpadCore\Container\HasInflectorInterface;
use LaunchpadCore\Container\PrefixAwareInterface;
use LaunchpadCore\Dispatcher\DispatcherAwareInterface;
use LaunchpadDispatcher\Dispatcher;
use LaunchpadUninstaller\Uninstall\Wrapper\UninstallerWrapper;
use League\Container\Argument\Literal\StringArgument;
use Psr\Container\ContainerInterface;

class Uninstall
{
    protected static $providers = [];

    protected static $params = [];

    protected static $container;

	/**
	 * Hook dispatcher.
	 *
	 * @var Dispatcher
	 */
	protected static $dispatcher;

    public static function set_providers(array $providers) {
        self::$providers = $providers;
    }

    public static function set_params(array $params) {
        self::$params = $params;
    }

    public static function set_container(ContainerInterface $container) {
        self::$container = $container;
    }

	/**
	 * Set hook dispatcher.
	 *
	 * @param Dispatcher $dispatcher Hook dispatcher.
	 * @return void
	 */
	public static function set_dispatcher( Dispatcher $dispatcher ): void {
		self::$dispatcher = $dispatcher;
	}

    public static function uninstall_plugin() {
		foreach ( self::$params as $key => $value ) {
			if ( is_string( $value ) && ! class_exists( $value ) ) {
				$value = new StringArgument( $value );
			}

			self::$container->addShared( $key, $value );
		}


		self::$container->addShared( 'dispatcher', self::$dispatcher );

		self::$container->inflector( PrefixAwareInterface::class )->invokeMethod( 'set_prefix', [ key_exists( 'prefix', self::$params ) ? self::$params['prefix'] : '' ] );
		self::$container->inflector( DispatcherAwareInterface::class )->invokeMethod( 'set_dispatcher', [ self::$container->get( 'dispatcher' ) ] );

		$providers = array_map(
			function ( $provider ) {
				if ( is_string( $provider ) ) {
					return new $provider();
				}
				return $provider;
			},
			self::$providers
		);

		foreach ( $providers as $provider ) {
			self::$container->addServiceProvider( $provider );
		}

		foreach ( $providers as $service_provider ) {
			if ( ! $service_provider instanceof HasInflectorInterface ) {
				continue;
			}
			$service_provider->register_inflectors();
		}

        $providers = array_filter($providers, function ($provider) {

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

		$wrapper = new UninstallerWrapper();

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
                $uninstaller_instance = $wrapper->wrap($uninstaller_instance);

                $uninstaller_instance->uninstall();
            }
        }
    }
}
