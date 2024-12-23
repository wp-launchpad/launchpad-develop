<?php

namespace LaunchpadCassette;

class Response
{
    protected $headers = [];

    protected $status = 200;

    protected $body = '';

    public function get_headers(): array
    {
        return $this->headers;
    }

    public function set_headers(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function get_status(): int
    {
        return $this->status;
    }

    public function set_status(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function get_body(): string
    {
        return $this->body;
    }

    public function set_body(string $body): self
    {
        $this->body = $body;
        return $this;
    }
}