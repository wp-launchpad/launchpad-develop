<?php

namespace LaunchpadCassette;

class Request
{
    protected $url = '';
    protected $method = 'GET';
    protected $headers = [];

    protected $responses = [];
    /**
     * @return mixed
     */
    public function get_url()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function set_url($url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_method()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function set_method($method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function get_headers()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function set_headers($headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function get_response(): array {
		/**
		 * @var Response $response
		 */
        $response = array_shift($this->responses);

        if(!$response) {
            return [];
        }

		return [
            'response' => [
                'code' => $response->get_status(),
            ],
            'body' => $response->get_body()
        ];
    }

	/**
	 * @return Response[]
	 */
	public function get_responses(): array {
		return $this->responses;
	}

    public function add_response(Response $response): self {
        $this->responses[] = $response;

        return $this;
    }

	public function applies(string $url, array $args): bool {
		if($url !== $this->url) {
			return false;
		}

        if( ! key_exists( 'method', $args ) && 'GET' !== $this->method) {
            return false;
        }

        if(key_exists('method', $args) && $this->method !== $args['method']) {
            return false;
        }

        if(key_exists('headers', $args) && ! $this->match_headers($args['headers']) ) {
            return false;
        }

		return true;
	}

    protected function match_headers(array $headers): bool
    {
        foreach ($headers as $header => $value) {
            if(! key_exists($header, $this->headers)) {
                return false;
            }

            if( $this->headers[$header] !== $value) {
                return false;
            }
        }

        return true;
    }
}