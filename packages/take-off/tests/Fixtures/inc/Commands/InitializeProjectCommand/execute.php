<?php
return [
    'vfs_dir' => '/',
    'structure' => [
        'bin' => [
          'generator' =>   file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator'),
        ],
        'configs' => [
            'parameters.php' =>   file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
            'providers.php' =>   file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/providers.php'),
        ],
        'inc' => [
            'main.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/main.php'),
            'Plugin.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php'),
            'Engine' => [
                'Test.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php'),
            ]
        ],
        'rocket-launcher.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php'),
        'composer.json' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json'),
        'tests' => [
            'Fixtures' => [
                'classes' => [

                ]
            ],
            'Integration' => [
                'TestCase.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/TestCase.php'),
                'bootstrap.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/bootstrap.php'),
            ],
            'Unit' => [
                'inc' => [

                ],
                'TestCase.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/TestCase.php'),
                'bootstrap.php' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/bootstrap.php'),
            ]
        ]
    ],
    'test_data' => [
        'straussShouldTransform' => [
            'config' => [
                'parameters' => ' -n "My test app"',
                'composer' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/strauss_composer.json'),
                'files' => [
                    'inc/main.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/main.php')
                    ],
                    'inc/Plugin.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php')
                    ],
                    'inc/Engine/Test.php' => [
                        'exists' => true,
                        'content' =>  file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php')
                    ],
                    'rocket-launcher.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php')
                    ],
                    'my-test-app.php' => [
                        'exists' => false,
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/strauss_composer.json')
                    ],
                    'tests/Unit/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/bootstrap.php')
                    ],
                    'tests/Unit/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/TestCase.php')
                    ],
                    'tests/Integration/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/bootstrap.php')
                    ],
                    'tests/Integration/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/TestCase.php')
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator')
                    ],
                    'phpcs.xml' => [
                        'exists' => false,
                    ],
                ]
            ],
            'expected' => [
                'files' => [
                    'inc/main.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/inc/main.php')
                    ],
                    'inc/Plugin.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/inc/Plugin.php')
                    ],
                    'inc/Engine/Test.php' => [
                        'exists' => true,
                        'content' =>  file_get_contents(__DIR__ . '/files/inc/Engine/Test.php')
                    ],
                    'rocket-launcher.php' => [
                        'exists' => false,
                    ],
                    'my-test-app.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/my-test-app.php')
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/strauss_composer.json')
                    ],
                    'tests/Unit/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Unit/bootstrap.php')
                    ],
                    'tests/Unit/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Unit/TestCase.php')
                    ],
                    'tests/Integration/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Integration/bootstrap.php')
                    ],
                    'tests/Integration/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Integration/TestCase.php')
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/bin/generator')
                    ],
                    'phpcs.xml' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/phpcs.xml')
                    ],
                ]
            ]
        ],
        'shouldTransform' => [
            'config' => [
                'parameters' => ' -n "My test app"',
                'files' => [
                    'inc/main.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/main.php')
                    ],
                    'inc/Plugin.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Plugin.php')
                    ],
                    'inc/Engine/Test.php' => [
                        'exists' => true,
                        'content' =>  file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/inc/Engine/Test.php')
                    ],
                    'rocket-launcher.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/rocket-launcher.php')
                    ],
                    'my-test-app.php' => [
                        'exists' => false,
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json')
                    ],
                    'tests/Unit/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/bootstrap.php')
                    ],
                    'tests/Unit/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Unit/TestCase.php')
                    ],
                    'tests/Integration/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/bootstrap.php')
                    ],
                    'tests/Integration/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/tests/Integration/TestCase.php')
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator')
                    ],
                    'phpcs.xml' => [
                        'exists' => false,
                    ],
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php')
                    ],
                    'configs/providers.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/providers.php')
                    ],
                ]
            ],
            'expected' => [
                'files' => [
                    'inc/main.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/inc/main.php')
                    ],
                    'inc/Plugin.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/inc/Plugin.php')
                    ],
                    'inc/Engine/Test.php' => [
                        'exists' => true,
                        'content' =>  file_get_contents(__DIR__ . '/files/inc/Engine/Test.php')
                    ],
                    'rocket-launcher.php' => [
                        'exists' => false,
                    ],
                    'my-test-app.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/my-test-app.php')
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/composer.json')
                    ],
                    'tests/Unit/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Unit/bootstrap.php')
                    ],
                    'tests/Unit/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Unit/TestCase.php')
                    ],
                    'tests/Integration/bootstrap.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Integration/bootstrap.php')
                    ],
                    'tests/Integration/TestCase.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/tests/Integration/TestCase.php')
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/bin/generator')
                    ],
                    'phpcs.xml' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/phpcs.xml')
                    ],
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/parameters.php')
                    ],
                    'configs/providers.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/providers.php')
                    ],
                ]
            ]
        ],
    ]
];
