<?php

use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\PS4Namespace;

return [
        '' => [
            'config' => [
                'old_namespace' => new PS4Namespace('RocketLauncher'),
                'old_test_namespace' => new PS4Namespace('RocketLauncher\\Tests'),
                'old_code_folder' => new Folder('inc/'),
                'old_test_folder' => new Folder('tests/'),
				"old_wordpress_key" => new \LaunchpadTakeOff\ObjectValues\WordPressKey('rocketlauncher'),
                'new_namespace' => new PS4Namespace('MyTestApp'),
                'new_test_namespace' => new PS4Namespace('MyTestApp\\Tests'),
				"new_wordpress_key" => new \LaunchpadTakeOff\ObjectValues\WordPressKey('mytestapp'),
				'files' => [

                ],
                'files_content' => [
					'configs/providers.php' => '',
					'rocketlauncher.php' => '',
					'mytestapp.php' => '',
                ]
            ],
            'expected' => [
                'old_code_folder_path' => 'inc/',
                'old_test_folder_path' => 'tests/',
                'files' => [
					[
						'path' => 'configs/providers.php',
						'has' => false,
						'content' => ''
					],
					[
						'path' => 'rocketlauncher.php',
						'has' => true,
						'content' => ''
					],
					[
						'path' => 'mytestapp.php',
						'has' => true,
						'content' => ''
					],
                ]
            ]
        ],
];
