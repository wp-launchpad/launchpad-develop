<?php

namespace LaunchpadHTTPClient;

use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;

class NetworkException extends ClientException implements NetworkExceptionInterface
{

    public function getRequest(): RequestInterface
    {
        // TODO: Implement getRequest() method.
    }
}