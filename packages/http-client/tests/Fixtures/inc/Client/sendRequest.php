<?php

use LaunchpadHTTPClient\NetworkException;
use LaunchpadHTTPClient\RequestException;

return [
    'requestSuccessfulShouldCreateResponse' => [
        'config' => [
            'request' => [
                'protocol' => '1.1',
                'headers' => [
                    'test' => ['value']
                ],
                'host' => [],
                'body' => 'test',
                'method' => 'GET'
            ],
            'uri' => [
                'scheme' => 'http',
                'host' => 'example.org',
                'path' => '/test',
                'authority' => 'example.org',
                'query' => 'param=true',
                'fragment' => 'hash=value',
            ],
            'response' => [
                'code' => 200,
                'message' => 'test',
                'body' => 'body',
                'headers' => []
            ]
        ],
        'expected' => [
            'body' => 'body',
            'response' => [
                'headers' => [],
                'code' => 200,
                'message' => 'test',
            ],
            'exception' => '',
            'options' => [
                "method" => "GET",
                "httpversion" => "1.1",
                "body" => "test",
                "headers" => [
                    "test" => "value"
                ]
            ],
            'url' => 'http://example.org/test?param=true#hash=value'
        ]
    ],
    'requestFailedShouldCreateResponse' => [
        'config' => [
            'request' => [
                'protocol' => '1.1',
                'headers' => [
                    'test' => ['value', 'value2']
                ],
                'host' => [],
                'body' => 'test',
                'method' => 'GET'
            ],
            'uri' => [
                'scheme' => 'http',
                'host' => 'example.org',
                'path' => '/test',
                'authority' => 'example.org',
                'query' => 'param=true',
                'fragment' => 'hash=value',
            ],
            'response' => [
                'code' => 400,
                'message' => 'test',
                'body' => 'body',
                'headers' => []
            ]
        ],
        'expected' => [
            'body' => 'body',
            'response' => [
                'headers' => [],
                'code' => 400,
                'message' => 'test',
            ],
            'exception' => '',
            'options' => [
                "method" => "GET",
                "httpversion" => "1.1",
                "body" => "test",
                "headers" => [
                    "test" => "value;value2"
                ]
            ],
            'url' => 'http://example.org/test?param=true#hash=value'
        ]
    ],
    'invalidRequestHostShouldRaiseError' =>  [
        'config' => [
            'error' => true,
            'request' => [
                'protocol' => '1.1',
                'headers' => [
                    'test' => ['value']
                ],
                'host' => [],
                'body' => 'test',
                'method' => 'GET'
            ],
            'uri' => [
                'scheme' => 'http',
                'host' => '',
                'path' => '/test',
                'authority' => 'example.org',
                'query' => 'param=true',
                'fragment' => 'hash=value',
            ],
            'response' => [
                'code' => 200,
                'message' => 'test',
                'body' => 'body',
                'headers' => []
            ]
        ],
        'expected' => [
            'body' => 'body',
            'response' => [
                'headers' => [],
                'code' => 200,
                'message' => 'test',
            ],
            'exception' => RequestException::class,
            'options' => [
                "method" => "GET",
                "httpversion" => "1.1",
                "body" => "test",
                "headers" => [
                    "test" => "value"
                ]
            ],
            'url' => 'http://example.org/test?param=true#hash=value'
        ]
    ],
    'invalidRequestMethodShouldRaiseError' =>  [
        'config' => [
            'error' => true,
            'request' => [
                'protocol' => '1.1',
                'headers' => [
                    'test' => ['value']
                ],
                'host' => [],
                'body' => 'test',
                'method' => ''
            ],
            'uri' => [
                'scheme' => 'http',
                'host' => 'example.org',
                'path' => '/test',
                'authority' => 'example.org',
                'query' => 'param=true',
                'fragment' => 'hash=value',
            ],
            'response' => [
                'code' => 200,
                'message' => 'test',
                'body' => 'body',
                'headers' => []
            ]
        ],
        'expected' => [
            'body' => 'body',
            'response' => [
                'headers' => [],
                'code' => 200,
                'message' => 'test',
            ],
            'exception' => RequestException::class,
            'options' => [
                "method" => "GET",
                "httpversion" => "1.1",
                "body" => "test",
                "headers" => [
                    "test" => "value"
                ]
            ],
            'url' => 'http://example.org/test?param=true#hash=value'
        ]
    ],
    'failSendRequestShouldRaiseError' => [
        'config' => [
            'error' => true,
            'request' => [
                'protocol' => '1.1',
                'headers' => [
                    'test' => ['value']
                ],
                'host' => [],
                'body' => 'test',
                'method' => 'GET'
            ],
            'uri' => [
                'scheme' => 'http',
                'host' => 'example.org',
                'path' => '/test',
                'authority' => 'example.org',
                'query' => 'param=true',
                'fragment' => 'hash=value',
            ],
            'response' => [
                'code' => '',
                'message' => 'test',
                'body' => 'body',
                'headers' => []
            ]
        ],
        'expected' => [
            'body' => 'body',
            'response' => [
                'headers' => [],
                'code' => 200,
                'message' => 'test',
            ],
            'exception' => NetworkException::class,
            'options' => [
                "method" => "GET",
                "httpversion" => "1.1",
                "body" => "test",
                "headers" => [
                    "test" => "value"
                ]
            ],
            'url' => 'http://example.org/test?param=true#hash=value'
        ]
    ]
];