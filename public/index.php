<?php

use App\Http\Request;
use Controllers\CacheController;
use Controllers\RequestController;
use GuzzleHttp\Client;
use Predis\Client as PredisClient;
use Src\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$request = Request::createFromGlobal();
$path = $request->getPath();
$method = $request->getMethod();

$httpClient = new Client(["base_uri" => "https://api.jsonplaceholder.dev"]);
$redisClient = new PredisClient();

$reqController = new RequestController(
    $request,
    $httpClient
);

$cacheController = new CacheController(
    $reqController,
    $redisClient
);

if (!Router::routeExists($reqController->getUniqueName())) {
    $cacheController->cacheNewRequest();
    Router::addRoute($reqController->getUniqueName());
} else {
    $cacheController->getCacheResponse();
}

