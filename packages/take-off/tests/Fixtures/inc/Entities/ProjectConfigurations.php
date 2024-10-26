<?php

use LaunchpadTakeOff\ObjectValues\ConstantPrefix;
use LaunchpadTakeOff\ObjectValues\Folder;
use LaunchpadTakeOff\ObjectValues\HookPrefix;
use LaunchpadTakeOff\ObjectValues\PS4Namespace;
use LaunchpadTakeOff\ObjectValues\TranslationKey;
use LaunchpadTakeOff\ObjectValues\URL;
use LaunchpadTakeOff\ObjectValues\Version;
use LaunchpadTakeOff\ObjectValues\WordPressKey;

return [
    'RocketLauncherShouldReturnRightValues' => [
        'config' => [
            'code_folder' => new Folder('inc/'),
            'test_folder' => new Folder('tests/'),
            'name' => 'Rocket Launcher',
            'description' => '',
            'author' => '',
            'url' => null,
            'min_php' => null,
            'min_wp' => null,
        ],
        'expected' => [
            'code_folder' => new Folder('inc/'),
            'test_folder' => new Folder('tests/'),
            'name' => 'Rocket Launcher',
            'description' => '',
            'author' => '',
            'url' => null,
            'min_php' => null,
            'min_wp' => null,
            'translation_key' => new TranslationKey('rocketlauncher'),
            'wordpress_key' => new WordPressKey('rocket-launcher'),
            'constant_prefix' => new ConstantPrefix('ROCKET_LAUNCHER_'),
            'hook_prefix' => new HookPrefix('rocket_launcher_'),
            'namespace' => new PS4Namespace('RocketLauncher'),
            'test_namespace' => new PS4Namespace('RocketLauncher\\Tests'),
        ]
    ],
    'MyTestAppShouldReturnRightValues' => [
        'config' => [
            'code_folder' => new Folder('inc/'),
            'test_folder' => new Folder('tests/'),
            'name' => 'My test app',
            'description' => 'A simple app',
            'author' => 'Cyrille',
            'url' => new URL('http://example.org'),
            'min_php' => new Version('1.2.3'),
            'min_wp' => new Version('5.0.1'),
        ],
        'expected' => [
            'code_folder' => new Folder('inc/'),
            'test_folder' => new Folder('tests/'),
            'name' => 'My test app',
            'description' => 'A simple app',
            'author' => 'Cyrille',
            'url' => new URL('http://example.org'),
            'min_php' => new Version('1.2.3'),
            'min_wp' => new Version('5.0.1'),
            'translation_key' => new TranslationKey('mytestapp'),
            'wordpress_key' => new WordPressKey('my-test-app'),
            'constant_prefix' => new ConstantPrefix('MY_TEST_APP_'),
            'hook_prefix' => new HookPrefix('my_test_app_'),
            'namespace' => new PS4Namespace('MyTestApp'),
            'test_namespace' => new PS4Namespace('MyTestApp\\Tests'),
        ]
    ]
];