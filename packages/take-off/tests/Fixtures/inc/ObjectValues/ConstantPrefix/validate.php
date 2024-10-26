<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'CONSTANT_PREFIX_',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'constant_prefix_',
        'expected' => false
    ]
];
