<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'my_folder_',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'CONSTANT_PREFIX_',
        'expected' => false
    ]
];
