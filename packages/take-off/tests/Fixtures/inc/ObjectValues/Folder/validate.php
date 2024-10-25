<?php
return [
    'validValueShouldReturnSameValue' => [
        'config' => 'test/my_folder/',
        'expected' => true
    ],
    'invalidShouldRaiseException' => [
        'config' => 'http://test/my_folder/index.php',
        'expected' => false
    ]
];
