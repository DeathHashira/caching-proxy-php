<?php

namespace Src;


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