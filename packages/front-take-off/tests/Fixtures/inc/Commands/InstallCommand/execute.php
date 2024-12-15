<?php

return [
    'vfs_dir' => '/',
    'structure' => [
        'configs' => [
            'parameters.php' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
            'providers.php' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/providers.php'),
        ],
        'bin' => [
            'generator' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator'),
        ],
        'composer.json' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json'),
    ],
    'test_data' => [
        'installReactShouldConfigureProject' => [
            'config' => [
                'parameters' => ' react',
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => false,
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => false,
                    ],
                    '_dev/.npmrc' => [
                        'exists' => false,
                    ],
                    '_dev/.gitignore' => [
                        'exists' => false,
                    ],
                    '_dev/src/app.js' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => false,
                    ],
                ]
            ],
            'expected' => [
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/parameters.php'),
                    ],
                    'configs/providers.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/providers.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/package.json' ),
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/bud.config.js' ),
                    ],
                    '_dev/.npmrc' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/.npmrc' ),
                    ],
                    '_dev/.gitignore' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/.gitignore' ),
                    ],
                    '_dev/src/app.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/src/app.js' ),
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/react/src/App.jsx' ),
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => false,
                    ],
                ]
            ]
        ],
        'installVanillaShouldConfigureProject' => [
            'config' => [
                'parameters' => ' vanilla',
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => false,
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => false,
                    ],
                    '_dev/.npmrc' => [
                        'exists' => false,
                    ],
                    '_dev/.gitignore' => [
                        'exists' => false,
                    ],
                    '_dev/src/app.js' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => false,
                    ],
                ]
            ],
            'expected' => [
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/parameters.php'),
                    ],
                    'configs/providers.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/providers.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vanilla/package.json' ),
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vanilla/bud.config.js' ),
                    ],
                    '_dev/.npmrc' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vanilla/.npmrc' ),
                    ],
                    '_dev/.gitignore' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vanilla/.gitignore' ),
                    ],
                    '_dev/src/app.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vanilla/src/app.js' ),
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => false,
                    ],
                ]
            ]
        ],
        'installVueShouldConfigureProject' => [
            'config' => [
                'parameters' => ' vue',
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/configs/parameters.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_TESTS_FIXTURES_DIR . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => false,
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => false,
                    ],
                    '_dev/.npmrc' => [
                        'exists' => false,
                    ],
                    '_dev/.gitignore' => [
                        'exists' => false,
                    ],
                    '_dev/src/app.js' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => false,
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => false,
                    ],
                ]
            ],
            'expected' => [
                'files' => [
                    'configs/parameters.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/parameters.php'),
                    ],
                    'configs/providers.php' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/configs/providers.php'),
                    ],
                    'composer.json' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/composer.json'),
                    ],
                    'bin/generator' => [
                        'exists' => true,
                        'content' => file_get_contents(__DIR__ . '/files/bin/generator'),
                    ],
                    '_dev/package.json' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/package.json' ),
                    ],
                    '_dev/bud.config.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/bud.config.js' ),
                    ],
                    '_dev/.npmrc' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/.npmrc' ),
                    ],
                    '_dev/.gitignore' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/.gitignore' ),
                    ],
                    '_dev/src/app.js' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/src/app.js' ),
                    ],
                    '_dev/src/App.vue' => [
                        'exists' => true,
                        'content' => file_get_contents(LAUNCHPAD_FRONT_TAKE_OFF_DIR . '/front/vue/src/App.vue' ),
                    ],
                    '_dev/src/App.jsx' => [
                        'exists' => false,
                    ],
                ]
            ]
        ],
    ],
];
