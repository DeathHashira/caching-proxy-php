<?php

namespace Src;

use App\Http\Response;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class Router
{
    public static $routes = [];

    public static function routeExists(string $hashRoute): bool
    {
        return in_array($hashRoute, Router::$routes);
    }

    public static function addRoute(string $newRoute): void
    {
        Router::$routes[] = $newRoute;
    }
}