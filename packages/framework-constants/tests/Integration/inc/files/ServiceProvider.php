<?php

namespace LaunchpadFrameworkConstants\Tests\Integration\inc\files;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{

    public function get_common_subscribers(): array
    {
        return [
          Subscriber::class,
        ];
    }

    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_service(Subscriber::class);
    }
}