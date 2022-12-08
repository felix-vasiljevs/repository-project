<?php

use App\Controllers\CryptoController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Redirect;
use App\Template;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

$dotenv = Dotenv\Dotenv::createImmutable("/home/spoon/PhpstormProjects/CODELEX/crypto-program");
$dotenv->load();

$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', $_ENV['API_KEY']);
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);

echo "<pre>";

//var_dump($client->quote('AAPL'));die;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [CryptoController::class, 'index']);
    $r->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
    $r->addRoute('POST', '/register', [RegisterController::class, 'registerUser']);
    $r->addRoute('GET', '/login', [LoginController::class, 'showForm']);
    $r->addRoute('POST', '/login', [LoginController::class, 'login']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $methods] = $handler;
        $response = (new $controller)->{$methods}($vars);

        if ($response instanceof Template) {
            echo $twig->render($response->getPath(), $response->getParams());

            unset($_SESSION);
        }

        if ($response instanceof Redirect) {
            header("Location: " . $response->getUrl());
        }
        // ... call $handler with $vars
        break;
}
?>
