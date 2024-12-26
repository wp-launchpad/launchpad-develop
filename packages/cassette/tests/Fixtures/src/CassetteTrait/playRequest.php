<?php
return [
	'requestShouldPlayRecorded' => [
		'configs' => [
			'url' => 'http://example.org',
			'parameters' => [

			],
			'root_path' => __DIR__ . '/data',
		],
		'expected' => [
            'code' => 200,
            'body' => 'test'
		]
	],
];