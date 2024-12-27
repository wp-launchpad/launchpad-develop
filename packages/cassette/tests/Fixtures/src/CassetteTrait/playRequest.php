<?php
return [
	'requestShouldPlayRecorded' => [
		'configs' => [
			'url' => 'http://example.org',
			'parameters' => [

			],
		],
		'expected' => [
            'code' => 200,
            'body' => 'test'
		]
	],
    'PostRequestShouldPlayRecorded' => [
        'configs' => [
            'url' => 'http://example.org',
            'parameters' => [
                'method' => 'POST',
            ],
        ],
        'expected' => [
            'code' => 200,
            'body' => 'test2'
        ]
    ],
    'ContentTypeRequestShouldPlayRecorded' => [
        'configs' => [
            'url' => 'http://example.org',
            'parameters' => [
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ],
        ],
        'expected' => [
            'code' => 200,
            'body' => 'test3'
        ]
    ],
    'TwoRequestsShouldPlayRecorded' => [
        'configs' => [
            'url' => 'http://example.org',
            'parameters' => [
            ],
        ],
        'expected' => [
            'code' => 200,
            'body' => 'test',
            'second_body' => 'test3',
        ]
    ],
];