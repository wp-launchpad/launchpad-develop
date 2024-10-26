<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'https://test.test/test/',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'test',
        'expected' => false
    ]
];
