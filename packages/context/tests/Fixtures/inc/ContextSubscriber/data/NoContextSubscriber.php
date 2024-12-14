<?php

namespace LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data;

class NoContextSubscriber
{
    /**
     *
     * @hook test
     */
    public function my_callback() {
        update_option('my_option', true);
    }
}