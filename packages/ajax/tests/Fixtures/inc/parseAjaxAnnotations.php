<?php

return [
    'ajaxAnnotationShouldAddToEvent' => [
        'config' => [
            'events' => [

            ],
            'classname' => \LaunchpadAjax\Tests\Fixtures\inc\data\AjaxAnnotationSubscriber::class
        ],
        'expected' => [
            'wp_ajax_event' => [
                ['save_admin', 10, 0]
            ]
        ]
    ],
    'ajaxAnnotationWithExistingEventShouldAddToEvent' => [
        'config' => [
            'events' => [
                'test_event' => [
                    ['save_my_settings', 10, 0]
                ],
            ],
            'classname' => \LaunchpadAjax\Tests\Fixtures\inc\data\AjaxAnnotationSubscriber::class
        ],
        'expected' => [
            'test_event' => [
                ['save_my_settings', 10, 0]
            ],
            'wp_ajax_event' => [
                ['save_admin', 10, 0]
            ]
        ]
    ],
    'ajaxNoPrivateAnnotationShouldAddToEvent' => [
        'config' => [
            'events' => [

            ],
            'classname' => \LaunchpadAjax\Tests\Fixtures\inc\data\AjaxNoPrivateAnnotationSubscriber::class
        ],
        'expected' => [
            'wp_ajax_nopriv_event' => [
                ['save_admin', 10, 0]
            ]
        ]
    ],
];