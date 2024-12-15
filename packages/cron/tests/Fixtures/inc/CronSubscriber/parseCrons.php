<?php

use LaunchpadCron\Tests\Fixtures\inc\CronSubscriber\data\CronSubscriber;

return [
    'CronShouldSchedule' => [
        'config' => [
            'events' => [],
            'classname' => CronSubscriber::class,
            'schedules' => []
        ],
        'expected' => [
            'events' => [
                'my-event' => [
                    ['action', 20, 0]
                ]
            ],
            'crons' => [
                'my-event' => 'my-scheduling'
            ],
            'schedules' => [
                'my-scheduling' => [
                    'interval' => CronSubscriber::WEEKLY,
                    'display' => 'my-scheduling'
                ],
            ],
        ]
    ]
];