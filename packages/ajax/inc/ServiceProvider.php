<?php

namespace LaunchpadAjax;

class ServiceProvider extends \LaunchpadCore\Container\AbstractServiceProvider
{
    protected function define()
    {
        $this->register_init_subscriber(Subscriber::class);
    }
}