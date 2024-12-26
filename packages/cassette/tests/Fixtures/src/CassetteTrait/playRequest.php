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
];