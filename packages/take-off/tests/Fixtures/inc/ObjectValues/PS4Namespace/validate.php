<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'MyNamespace\Sub',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'My_namespace\test12',
        'expected' => false
    ]
];
