<?php
return [
    'vfs_dir' => '/',
    'structure' => [
        'composer.json' => file_get_contents(ROCKER_LAUNCHER_BUILDER_TESTS_FIXTURES_DIR . '/composer.php'),
    ],
    'test_data' => [
            'shouldGenerateClasses' => [
                'config' => [
                    'query_path' => 'inc/Domains/MyQuery.php',
                    'query_handler_path' => 'inc/Domains/QueryHandlers/MyQueryHandler.php',
                    'query_result_path' => 'inc/Domains/QueryResults/MyQueryResult.php',
                    'class' => 'PSR2Plugin/Domains/MyQuery',
                ],
                'expected' => [
                    'query_path' => 'inc/Domains/MyQuery.php',
                    'query_handler_path' => 'inc/Domains/QueryHandlers/MyQueryHandler.php',
                    'query_result_path' => 'inc/Domains/QueryResults/MyQueryResult.php',
                    'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                    'query_handler_content' => file_get_contents(__DIR__ . '/files/query_handler.php'),
                    'query_result_content' => file_get_contents(__DIR__ . '/files/query_result.php')
                ]
            ],
        ]

];
