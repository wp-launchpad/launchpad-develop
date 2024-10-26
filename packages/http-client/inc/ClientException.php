<?php

namespace LaunchpadHTTPClient;

use Exception;
use Psr\Http\Client\ClientExceptionInterface;

class ClientException extends Exception implements ClientExceptionInterface
{

}