<?php
return [
    'budAssetWithDependenciesShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.js',
            'dependencies' => [
                'jquery'
            ],
            'in_footer' => false,
            'exists' => true,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'js' => [
                        'dependency.js',
                        'app.hash.js',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'in_footer' => false,
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_scripts' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'http://example.org/wp-content/plugin/assets/app.hash.js',
					'dependencies' => [
						'jquery',
						'plugin_slughttp://example.org/wp-content/plugin/assets/dependency.js'
					],
				],
			],
			'register_scripts' => [
				[
					'key' => 'plugin_slughttp://example.org/wp-content/plugin/assets/dependency.js',
					'url' => 'http://example.org/wp-content/plugin/assets/dependency.js',
					'dependencies' => [
						'jquery',
					],
				],
			],
        ]
    ],
    'notBudAssetWithDependenciesShouldRegisterAll' => [
        'config' => [
            'key' => 'key',
            'url' => 'app2.js',
            'dependencies' => [
                'jquery'
            ],
            'in_footer' => false,
            'exists' => true,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'js' => [
                        'dependency.js',
                        'app.hash.js',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'in_footer' => false,
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_scripts' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app2.js',
					'dependencies' => [
						'jquery',
					],
				],
			],
			'register_scripts' => [
			],
        ]
    ],
    'budAssetWithDependenciesWithoutEntryFileShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.js',
            'dependencies' => [
                'jquery'
            ],
            'in_footer' => false,
            'exists' => false,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'js' => [
                        'dependency.js',
                        'app.hash.js',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'in_footer' => false,
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_scripts' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app.js',
					'dependencies' => [
						'jquery',
					],
				],
			],
			'register_scripts' => [
            ]
        ]
    ],
    'budAssetWithDependenciesWithoutEntryFileContentShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.js',
            'dependencies' => [
                'jquery'
            ],
            'in_footer' => false,
            'exists' => false,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => ''
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'in_footer' => false,
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_scripts' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app.js',
					'dependencies' => [
						'jquery',
					],
				],
			],
			'register_scripts' => [

            ]
        ]
    ],
];
