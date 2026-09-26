<?php

namespace App\Http;

class Response
{
    private int $statusCode;
    private array $headers = [];
    private mixed $content;

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader(string $header): self
    {
        $this->headers[] = $header;
        return $this;
    }

    public function setHeaders(array $headers): self
    {
        foreach ($headers as $key => $values) {
            $header = $key . ': ' . implode(', ', $values);
            $this->setHeader($header);
        }
        return $this;
    }

    public function setContent(mixed $body): self
    {
        $this->content = $body;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): mixed
    {
        return json_encode($this->content);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function send()
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->getContent();
    }
}