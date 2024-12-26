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
        $response = $this->responses[0];

		return [
            'response' => [
                'code' => $response->get_status(),
            ],
            'body' => $response->get_body()
        ];
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

		return true;
	}
}