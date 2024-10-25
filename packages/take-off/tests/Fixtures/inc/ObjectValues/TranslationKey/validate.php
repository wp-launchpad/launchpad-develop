<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'mykey',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'my-key',
        'expected' => false
    ]
];
