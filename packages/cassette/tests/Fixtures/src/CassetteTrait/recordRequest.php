<?php
return [
	'RequestShouldBeRecorded' => [
		'config' => [
			'url' => 'http://example.org',
			'parameters' => [

			],
			'response' => [
				'response' => [
					'code' => 200,
				],
				'body' => 'test'
			]
		],
		'expected' => [
			'code' => 200,
			'body' => 'test',
			'path' => ROCKER_LAUNCHER_DATABASE_TESTS_CASSETTES_DIR . '/LaunchpadCassette/Tests/Integration/src/CassetteTrait/Test_recordRequest/testShouldDoAsExpected/RequestShouldBeRecorded.yaml',
			'content' => file_get_contents(__DIR__ . '/data/RequestShouldBeRecorded.yaml')
		]
	],
	'PreviousRequestsShouldBeRecorded' => [
		'config' => [
			'url' => 'http://example.org',
			'second_url' => 'http://example.org/2',
			'parameters' => [

			],
			'response' => [
				'response' => [
					'code' => 200,
				],
				'body' => 'test'
			],
			'second_response' => [
				'response' => [
					'code' => 200,
				],
				'body' => 'test2'
			],
			'content' => file_get_contents(__DIR__ . '/data/PreviousRequestsShouldBeRecorded_old.yaml')
		],
		'expected' => [
			'code' => 200,
			'body' => 'test',
			'path' => ROCKER_LAUNCHER_DATABASE_TESTS_CASSETTES_DIR . '/LaunchpadCassette/Tests/Integration/src/CassetteTrait/Test_recordRequest/testShouldDoAsExpected/PreviousRequestsShouldBeRecorded.yaml',
			'content' => file_get_contents(__DIR__ . '/data/PreviousRequestsShouldBeRecorded_new.yaml')
		]
	],
];