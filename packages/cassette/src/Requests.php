<?php

namespace LaunchpadCassette;

class Requests
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

    public function get_response() {
        return $this->responses;
    }

    public function add_response(Response $response): self {
        $this->responses[] = $response;

        return $this;
    }
}