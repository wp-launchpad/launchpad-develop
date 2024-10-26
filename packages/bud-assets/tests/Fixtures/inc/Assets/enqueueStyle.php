<?php
return [
    'budAssetWithDependenciesShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.css',
            'dependencies' => [
                'bootstrap'
            ],
            'media' => 'all',
            'exists' => true,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'css' => [
                        'dependency.css',
                        'app.hash.css',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'media' => 'all',
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
            'enqueue_styles' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'http://example.org/wp-content/plugin/assets/app.hash.css',
					'dependencies' => [
						'bootstrap',
						'plugin_slughttp://example.org/wp-content/plugin/assets/dependency.css'
					],
				],
            ],
			'register_styles' => [
				[
					'key' => 'plugin_slughttp://example.org/wp-content/plugin/assets/dependency.css',
					'url' => 'http://example.org/wp-content/plugin/assets/dependency.css',
					'dependencies' => [
						'bootstrap',
					],
				],
			],
        ]
    ],
    'notBudAssetWithDependenciesShouldRegisterAll' => [
        'config' => [
            'key' => 'key',
            'url' => 'app2.css',
            'dependencies' => [
                'bootstrap'
            ],
            'media' => 'all',
            'exists' => true,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'css' => [
                        'dependency.css',
                        'app.hash.css',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'media' => 'all',
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
            'enqueue_styles' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app2.css',
					'dependencies' => [
						'bootstrap',
					],
				],
            ],
			'register_styles' => [
			],
        ]
    ],
    'budAssetWithDependenciesWithoutEntryFileShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.css',
            'dependencies' => [
                'bootstrap'
            ],
            'media' => 'all',
            'exists' => false,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => json_encode([
                'app' => [
                    'css' => [
                        'dependency.css',
                        'app.hash.css',
                    ]
                ]
            ])
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'media' => 'all',
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_styles' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app.css',
					'dependencies' => [
						'bootstrap',
					],
				],
			],
			'register_styles' => [

			],
        ]
    ],
    'budAssetWithDependenciesWithoutEntryFileContentShouldRegisterAlone' => [
        'config' => [
            'key' => 'key',
            'url' => 'app.css',
            'dependencies' => [
                'bootstrap'
            ],
            'media' => 'all',
            'exists' => false,
            'plugin_url' => 'http://example.org/wp-content/plugin',
            'content' => ''
        ],
        'expected' => [
            'plugin_version' => '1.0.0',
            'media' => 'all',
            'entrypoints_path' => '/path/wp-content/plugin//assets/entrypoints.json',
			'enqueue_styles' => [
				[
					'key' => 'plugin_slugkey',
					'url' => 'app.css',
					'dependencies' => [
						'bootstrap',
					],
				],
			],
			'register_styles' => [
			],
        ]
    ],
];
