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
];