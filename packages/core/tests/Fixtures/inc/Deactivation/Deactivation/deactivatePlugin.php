<?php

use LaunchpadCore\Deactivation\DeactivationInterface;
use LaunchpadCore\Tests\Fixtures\inc\Deactivation\Deactivation\classes\DeactivatorServiceProvider;
use LaunchpadCore\Tests\Fixtures\inc\Deactivation\Deactivation\classes\ServiceProvider;
use LaunchpadCore\Tests\Fixtures\inc\Deactivation\Deactivation\classes\VisibleServiceProvider;

$deactivator = Mockery::mock(DeactivationInterface::class);

$provider = Mockery::mock(ServiceProvider::class);

$visible_provider = Mockery::mock(VisibleServiceProvider::class);

$deactivator_provider = Mockery::mock(DeactivatorServiceProvider::class);

return [
    'testShouldLoadDeactivator' => [
        'config' => [
            'deactivators' => [
                $deactivator
            ],
            'params' => [],
            'providers' => [
                [
                    'provider' => $provider,
                    'callbacks' => [
                        'get_deactivators' => [],
                        'get_inflectors' => [],
                    ]
                ],
                [
                    'provider' => $visible_provider,
                    'callbacks' => [
                        'get_deactivators' => [],
                    ]
                ],
                [
                    'provider' => $deactivator_provider,
                    'callbacks' => [
                        'get_deactivators' => [get_class($deactivator)],
                    ]
                ],
            ]
        ],
        'expected' => [
            'providers' => [
                $visible_provider,
                $deactivator_provider
            ],
            'deactivators' => [
                $deactivator
            ]
        ]
    ]
];
