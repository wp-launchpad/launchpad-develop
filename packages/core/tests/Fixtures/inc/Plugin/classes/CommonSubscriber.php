<?php

namespace LaunchpadCore\Tests\Fixtures\inc\Plugin\classes;

use LaunchpadCore\EventManagement\SubscriberInterface;

class CommonSubscriber implements SubscriberInterface
{

    public function get_subscribed_events()
    {
        return [];
    }
}