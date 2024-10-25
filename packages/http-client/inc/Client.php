<?php
namespace LaunchpadHTTPClient;

use HttpSoft\Message\ResponseFactory;
use HttpSoft\Message\StreamFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriInterface;

class Client implements ClientInterface
{

    /**
     * Factory to generate Response.
     *
     * @var ResponseFactoryInterface
     */
    protected $responseFactory;

    /**
     * Factory to generate Stream.
     *
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * Instantiate the class.
     *
     * @param ResponseFactoryInterface|null $responseFactory Factory to generate Response.
     * @param StreamFactoryInterface|null $streamFactory Factory to generate Stream.
     */
    public function __construct(ResponseFactoryInterface $responseFactory = null, StreamFactoryInterface $streamFactory = null)
    {
        $this->responseFactory = $responseFactory ?: new ResponseFactory();
        $this->streamFactory = $streamFactory ?: new StreamFactory();
    }

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $method = $request->getMethod();

        if(! $method) {
            throw new RequestException('The method is invalid');
        }

        $headers = $request->getHeaders();
        $body = $request->getBody()->getContents();

        $args = [
            'method' => $method,
            'httpversion' => $request->getProtocolVersion(),
        ];

        if($body) {
            $args['body'] = $body;
        }

        if(count($headers) > 0) {
            $wp_headers = [];

            foreach ($headers as $header => $values) {
                $wp_headers[$header] = implode(';', $values);
            }

            $args['headers'] = $wp_headers;
        }

        return $this->generateResponse(wp_remote_request($this->generateURL($request->getUri()), $args));
    }

    protected function generateURL(UriInterface $uri): string {

        if(! $uri->getHost()) {
            throw new RequestException('The URI has no Host');
        }

        $url = '';

        $scheme = $uri->getScheme();

        if ( $scheme !== '') {
            $url .= $scheme . ':';
        }

        $authority = $uri->getAuthority();

        if ($authority !== '') {
            $url .= '//' . $authority;
        }

        $path = $uri->getPath();

        if ($path !== '') {
            if ($authority === '') {
                $url .= $path === '/' ? '/' . ltrim($path, '/') : $path;
            } else {
                $url .= $path[0] === '/' ? $path : '/' . $path;
            }
        }

        $query = $uri->getQuery();

        if ($query !== '') {
            $url .= '?' . $query;
        }

        $fragment = $uri->getFragment();

        if ($fragment !== '') {
            $url .= '#' . $fragment;
        }

        return $url;
    }

    protected function generateResponse($response): ResponseInterface {

        if( is_wp_error( $response ) ) {
            return $this->responseFactory->createResponse($response->get_error_code(), $response->get_error_message());
        }

        if(! wp_remote_retrieve_response_code( $response )) {
            throw new NetworkException('The request cannot be sent');
        }

        $psr_response = $this->responseFactory->createResponse(wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_response_message( $response ));

        $response_body = wp_remote_retrieve_body( $response );
        if($response_body) {
            $psr_response = $psr_response->withBody($this->streamFactory->createStream($response_body));
        }

        $headers = wp_remote_retrieve_headers( $response );

        foreach ($headers as $header => $value) {
            $psr_response = $psr_response->withHeader($header, $value);
        }

        return $psr_response;
    }
}