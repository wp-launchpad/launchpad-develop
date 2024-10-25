<?php

namespace LaunchpadHTTPClient;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;

class RequestException extends ClientException implements RequestExceptionInterface
{

    /**
     * @inheritDoc
     */
    public function getRequest(): RequestInterface
    {
        // TODO: Implement getRequest() method.
    }
}