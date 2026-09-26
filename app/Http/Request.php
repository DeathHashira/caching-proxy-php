<?php

namespace App\Http;

class Request
{
    private string $method;
    private string $path;

    public function __construct(
        private array $postParams,
        private array $getParams,
        private array $server
    )
    {
        $this->method = strtolower($this->server["REQUEST_METHOD"]);
        $this->path = parse_url($this->server["REQUEST_URI"])["path"];
    }

    public static function createFromGlobal(): self
    {
        return new self($_POST, $_GET, $_SERVER);
    }

    public function is_post(): bool
    {
        return ($this->method === "post") ? true : false;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function params(): array
    {
        if ($this->is_post()) {
            return $this->postParams;
        } else {
            return $this->getParams;
        }
    }

    public function getHeaders(): array
    {
        return getallheaders();
    }
}