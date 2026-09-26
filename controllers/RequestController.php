<?php

namespace Controllers;

use App\Http\Request;
use App\Http\Response;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class RequestController
{
    public function __construct(
        private Request $request,
        private Client $client
    ) {}

    public function getUniqueName(): string
    {
        return $this->request->getMethod() . implode("", 
        explode("/", $this->request->getPath())
        );
    }

    public function sendRequest(): Response
    {
        $response = $this->client->request(
            strtoupper($this->request->getMethod()),
            ltrim($this->request->getPath(), "/")
        );

        return $this->formatResponse($response);
    }

    private function formatResponse(ResponseInterface $response): Response
    {
        return (new Response())
        ->setStatusCode($response->getStatusCode())
        ->setHeaders($response->getHeaders())
        ->setContent($response->getBody());
    }
}