<?php

namespace Unit\inc\Client;

use LaunchpadHTTPClient\Client;
use LaunchpadHTTPClient\Tests\Unit\TestCase;
use Mockery;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Brain\Monkey\Functions;

class Test_SendRequest extends TestCase
{
    protected $client;

    protected $responseFactory;

    protected $streamFactory;

    protected $response;

    protected $request;

    protected $uri;

    protected $request_stream;

    protected $response_stream;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = Mockery::mock(RequestInterface::class);
        $this->uri = Mockery::mock(UriInterface::class);
        $this->responseFactory = Mockery::mock(ResponseFactoryInterface::class);
        $this->streamFactory = Mockery::mock(StreamFactoryInterface::class);
        $this->request_stream = Mockery::mock(StreamInterface::class);
        $this->response_stream = Mockery::mock(StreamInterface::class);
        $this->response = Mockery::mock(ResponseInterface::class);
        $this->client = new Client($this->responseFactory, $this->streamFactory);
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldReturnAsExpected($config, $excepted) {
        $this->configureRequest($config);
        $this->configureSendRequest($config, $excepted);
        $this->configureError($config, $excepted);
        $this->configureResponse($config, $excepted);
        $response = $this->client->sendRequest($this->request);

        $this->assertSame($response, $this->response);
    }

    protected function configureRequest($config) {
        $this->request->expects()->getMethod()->andReturn($config['request']['method']);

        if($config['request']['method'] === '') {
            return;
        }

        $this->request->expects()->getHeaders()->andReturn($config['request']['headers']);
        $this->request->expects()->getUri()->andReturn($this->uri);
        $this->request->expects()->getProtocolVersion()->andReturn($config['request']['protocol']);

        $this->uri->expects()->getHost()->andReturn($config['uri']['host']);

        $this->request->expects()->getBody()->andReturn($this->request_stream);
        $this->request_stream->expects()->getContents()->andReturn($config['request']['body']);

        if($config['uri']['host'] === '') {
            return;
        }


        $this->uri->expects()->getScheme()->andReturn($config['uri']['scheme']);
        $this->uri->expects()->getPath()->andReturn($config['uri']['path']);
        $this->uri->expects()->getAuthority()->andReturn($config['uri']['authority']);
        $this->uri->expects()->getQuery()->andReturn($config['uri']['query']);
        $this->uri->expects()->getFragment()->andReturn($config['uri']['fragment']);
    }

    protected function configureError($config, $expected) {
        if(! key_exists('error', $config)) {
            return;
        }

        $this->expectException($expected['exception']);
    }

    protected function configureResponse($config, $expected) {
        if($config['uri']['host'] === '' || $config['request']['method'] === '') {
            return;
        }
        Functions\expect('wp_remote_retrieve_response_code')->with($expected['response'])->andReturn($config['response']['code']);
        if(! $config['response']['code']) {
            return;
        }
        Functions\expect('wp_remote_retrieve_response_message')->with($expected['response'])->andReturn($config['response']['message']);
        $this->responseFactory->expects()->createResponse($expected['response']['code'], $expected['response']['message'])->andReturn($this->response);
        Functions\expect('wp_remote_retrieve_body')->with($expected['response'])->andReturn($config['response']['body']);
        $this->streamFactory->expects()->createStream($expected['body'])->andReturn($this->response_stream);
        $this->response->expects()->withBody($this->response_stream)->andReturnSelf();
        Functions\expect('wp_remote_retrieve_headers')->with($expected['response'])->andReturn($config['response']['headers']);
        foreach ($expected['response']['headers'] as $header => $value) {
            $this->response->expects()->withHeader($header, $value)->andReturnSelf();
        }
    }

    protected function configureSendRequest($config, $expected) {
        if($config['uri']['host'] === '' || $config['request']['method'] === '') {
            return;
        }
        Functions\expect('wp_remote_request')->with($expected['url'], $expected['options'])->andReturn($config['response']);
    }
}