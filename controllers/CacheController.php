<?php

namespace Controllers;

use App\Http\Response;
use Exception;
use Predis\Client;

class CacheController
{
    
    public function __construct(
        private RequestController $reqController,
        private Client $redis
    ) {}

    public function cacheNewRequest(): void
    {
        try {
            $response = $this->reqController->sendRequest();

            $cacheRes = json_encode([
                "headers" => $response->getHeaders(),
                "content" => $response->getContent()
            ]);

            $this->redis->set(
                $this->reqController->getUniqueName(),
                $cacheRes,
                "EX",
                600
            );
        } catch (Exception $e) {
            $response = (new Response())
            ->setStatusCode(400);
        }

        $response->send();
    }

    public function getCacheResponse(): array
    {
        $encodedRes = $this->redis->get(
            $this->reqController->getUniqueName()
        );

        return json_decode($encodedRes);
    }
}