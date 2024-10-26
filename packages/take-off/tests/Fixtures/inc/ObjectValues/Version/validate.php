<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => '1.2.5',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => '1.a.2',
        'expected' => false
    ]
];
