<?php

namespace PSR2Plugin;

use PSR2Plugin\Dependencies\League\Container\ServiceProvider\ServiceProviderInterface;
use PSR2Plugin\Dependencies\League\Container\Container;
use PSR2Plugin\EventManagement\EventManager;
use PSR2Plugin\EventManagement\SubscriberInterface;

class Plugin
{
    /**
     * Instance of Container class.
     *
     * @since 3.3
     *
     * @var Container instance
     */
    private $container;

    /**
     * Instance of the event manager.
     *
     * @since 3.6
     *
     * @var EventManager
     */
    private $event_manager;

    /**
     * Creates an instance of the Plugin.
     *
     * @since 3.0
     *
     * @param Container $container     Instance of the container.
     */
    public function __construct( Container $container ) {
        $this->container = $container;

        add_filter( 'psr2_plugin_container', [ $this, 'get_container' ] );

    }

    /**
     * Returns the Rocket container instance.
     *
     * @return Container
     */
    public function get_container() {
        return $this->container;
    }

    /**
     * Loads the plugin into WordPress.
     *
     * @since 3.0
     *
     * @return void
     */
    public function load(string $plugin_name, string $template_path) {
        $this->event_manager = new EventManager();
        $this->container->share( 'plugin_name', $plugin_name );
        $this->container->share( 'template_path', $template_path );
        $this->container->share( 'event_manager', $this->event_manager );
        foreach ( $this->get_service_providers() as $service_provider ) {
            $this->container->addServiceProvider( $service_provider );
            $service_provider_instance = new $service_provider();
            $this->load_subscribers( $service_provider_instance );
        }
    }

    /**
     * Get list of service providers' classes.
     *
     * @return array Service providers.
     */
    private function get_service_providers() {
        $providers = [
            // Add new service providers here.
            \PSR2Plugin\Engine\Test\MyProvider::class,
        ];

        return $providers;
    }



    /**
     * Load list of event subscribers from service provider.
     *
     * @param ServiceProviderInterface $service_provider_instance Instance of service provider.
     *
     * @return void
     */
    private function load_subscribers( ServiceProviderInterface $service_provider_instance ) {
        if ( empty( $service_provider_instance->subscribers ) ) {
            return;
        }

        foreach ( $service_provider_instance->subscribers as $subscriber ) {
            $subscriber_object = $this->container->get( $subscriber );
            if ( $subscriber_object instanceof SubscriberInterface ) {
                $this->container->get( 'event_manager' )->add_subscriber( $subscriber_object );
            }
        }
    }
}
