<?php

namespace LaunchpadFrameworkOptions\Tests\Integration\inc\files;

use LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritDoc
     */
    protected function define()
    {
        $this->register_common_subscriber(Subscriber::class);
    }
}