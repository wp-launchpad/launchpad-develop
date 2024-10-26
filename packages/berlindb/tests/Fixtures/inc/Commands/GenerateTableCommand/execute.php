<?php

return [
    'vfs_dir' => '/',
    'structure' => [
        'inc' => [
            'Plugin.php' => file_get_contents(ROCKER_LAUNCHER_DATABASE_TESTS_FIXTURES_DIR . '/files/plugin.php'),
            'Engine' => [
                'Test' => [
                    'Database' => [
                        'ServiceProvider.php' => file_get_contents(__DIR__ . '/files/base_provider.php'),
                    ]
                ]
            ]
        ],
        'composer.json' => file_get_contents(ROCKER_LAUNCHER_DATABASE_TESTS_FIXTURES_DIR . '/files/composer.json'),
        'tests' => [
            'Fixtures' => [
                'classes' => [

                ]
            ],
            'Integration' => [

            ],
            'Unit' => [
                'inc' => [

                ],
            ]
        ]
    ],
    'test_data' => [
        'generateTableWithoutProviderShouldGenerateItAndRegister' => [
            'config' => [
                'parameters' => '',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Test',
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => false,
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/provider.php'),
                'plugin_content' => file_get_contents(__DIR__ . '/files/plugin.php'),
            ]
        ],
        'generateTableWithProviderShouldRegister' => [
            'config' => [
                'parameters' => '',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Test',
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => true,
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/provider.php'),
                'plugin_content' => file_get_contents(ROCKER_LAUNCHER_DATABASE_TESTS_FIXTURES_DIR . '/files/plugin.php')
            ]
        ],
        'generateTableWithAutoresolverShouldRegister' => [
            'config' => [
                'parameters' => ' --provider autoresolver',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Test',
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => false,
                'composer_path' => 'composer.json',
                'composer_content' => file_get_contents(ROCKER_LAUNCHER_DATABASE_TESTS_FIXTURES_DIR . '/files/composer_autoresolver.json'),
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/autoresolver.php'),
                'plugin_content' => file_get_contents(__DIR__ . '/files/plugin.php')
            ]
        ],
        'generateTableWithAutoresolverShortShouldRegister' => [
            'config' => [
                'parameters' => ' -p a',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Test',
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => false,
                'composer_path' => 'composer.json',
                'composer_content' => file_get_contents(ROCKER_LAUNCHER_DATABASE_TESTS_FIXTURES_DIR . '/files/composer_autoresolver.json'),
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/autoresolver.php'),
                'plugin_content' => file_get_contents(__DIR__ . '/files/plugin.php')
            ]
        ],
        'generateTableWithFieldsShouldGenerateRows' => [
            'config' => [
                'parameters' => ' --fields string:name,datetime:birthday',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Test',
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => false,
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/fields/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/fields/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/fields/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/provider.php'),
                'plugin_content' => file_get_contents(__DIR__ . '/files/plugin.php')
            ]
        ],
        'generateTableSubnamespacehouldAdapt' => [
            'config' => [
                'parameters' => ' --fields string:name,datetime:birthday',
                'table' => 'my_table',
                'folder' => 'PSR2Plugin/Engine/Sub/Test',
                'query_path' => '/inc/Engine/Sub/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Sub/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Sub/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Sub/Test/Database/Schemas/MyTable.php',
                'provider_path' => '/inc/Engine/Sub/Test/Database/ServiceProvider.php',
                'plugin_path' => '/inc/Plugin.php',
                'provider_exists' => false,
            ],
            'expected' => [
                'query_path' => '/inc/Engine/Sub/Test/Database/Queries/MyTable.php',
                'row_path' => '/inc/Engine/Sub/Test/Database/Rows/MyTable.php',
                'table_path' => '/inc/Engine/Sub/Test/Database/Tables/MyTable.php',
                'schema_path' => '/inc/Engine/Sub/Test/Database/Schemas/MyTable.php',
                'query_content' => file_get_contents(__DIR__ . '/files/sub/query.php'),
                'row_content' => file_get_contents(__DIR__ . '/files/sub/row.php'),
                'table_content' => file_get_contents(__DIR__ . '/files/sub/table.php'),
                'schema_content' => file_get_contents(__DIR__ . '/files/sub/schema.php'),
                'provider_content' => file_get_contents(__DIR__ . '/files/sub/provider.php'),
                'plugin_content' => file_get_contents(__DIR__ . '/files/sub/plugin.php')
            ]
        ]
    ]
];
