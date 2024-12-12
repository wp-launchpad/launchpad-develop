<?php

return [
	'disabledContextShouldNotCall' => [
		'config' => [
			'subscriber' => \Fixtures\inc\ContextSubscriber\data\Subscriber::class,
			'method' => 'my_callback'
		],
		'expected' => [
			'called' => false,
		]
	],
];