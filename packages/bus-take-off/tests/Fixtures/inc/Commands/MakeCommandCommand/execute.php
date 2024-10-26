<?php
return [
    'vfs_dir' => '/',
    'structure' => [
        'composer.json' => file_get_contents(ROCKER_LAUNCHER_BUILDER_TESTS_FIXTURES_DIR . '/composer.php'),
    ],
    'test_data' => [
        'shouldGenerateClasses' => [
            'config' => [
                'command_path' => 'inc/Domains/MyCommand.php',
                'command_handler_path' => 'inc/Domains/CommandHandlers/MyCommandHandler.php',
                'class' => 'PSR2Plugin/Domains/MyCommand',
            ],
            'expected' => [
                'command_path' => 'inc/Domains/MyCommand.php',
                'command_handler_path' => 'inc/Domains/CommandHandlers/MyCommandHandler.php',
                'command_content' => file_get_contents(__DIR__ . '/files/command.php'),
                'command_handler_content' => file_get_contents(__DIR__ . '/files/command_handler.php')
            ]
        ],
    ]
];
