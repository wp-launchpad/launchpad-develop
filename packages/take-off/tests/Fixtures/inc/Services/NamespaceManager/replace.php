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
                'new_namespace' => new PS4Namespace('MyTestApp'),
                'new_test_namespace' => new PS4Namespace('MyTestApp\\Tests'),
                'files' => [

                ],
                'files_content' => [

                ]
            ],
            'expected' => [
                'old_code_folder_path' => 'inc/',
                'old_test_folder_path' => 'tests/',
                'files' => [

                ]
            ]
        ],
];
