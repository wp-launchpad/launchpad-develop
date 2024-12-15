<?php

namespace LaunchpadCron\Tests\Fixtures\inc\CronSubscriber\data;

class CronSubscriber
{
    /**
     * @cron-schedule my-scheduling
     */
    const WEEKLY = 7 * DAY_IN_SECONDS;

    /**
     * @cron my-event 20 my-scheduling
     */
    public function action()
    {

    }
}