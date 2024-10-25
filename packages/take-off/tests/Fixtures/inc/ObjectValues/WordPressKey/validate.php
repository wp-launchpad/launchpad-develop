<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'my-wordpress-key',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'my_wordpress_key',
        'expected' => false
    ]
];
