<?php

use LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\EnabledSubscriber;
use LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\Subscriber;

return [
	'disabledContextShouldNotCall' => [
		'config' => [
			'subscriber' => Subscriber::class,
			'method' => 'my_callback'
		],
		'expected' => [
			'called' => false,
		]
	],
	'enabledContextShouldCall' => [
		'config' => [
			'subscriber' => EnabledSubscriber::class,
			'method' => 'my_callback'
		],
		'expected' => [
			'called' => true,
		]
	],
    'noContextShouldCall' => [
        'config' => [
            'subscriber' => \LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\NoContextSubscriber::class,
            'method' => 'my_callback'
        ],
        'expected' => [
            'called' => true,
        ]
    ],
    'TrailingSlashShouldCall' => [
        'config' => [
            'subscriber' => \LaunchpadContext\Tests\Fixtures\inc\ContextSubscriber\data\TrailingSubscriber::class,
            'method' => 'my_callback'
        ],
        'expected' => [
            'called' => false,
        ]
    ],
];