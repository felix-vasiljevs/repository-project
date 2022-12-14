<?php

use App\Controllers\CryptoController;
use App\Controllers\ForgotPasswordController;
use App\Controllers\LoginController;
use App\Controllers\RegisterController;
use App\Redirect;
use App\Template;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

\App\Session::initialize();

$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [CryptoController::class, 'index']);
    $r->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
    $r->addRoute('POST', '/register', [RegisterController::class, 'registerUser']);
    $r->addRoute('GET', '/login', [LoginController::class, 'showForm']);
    $r->addRoute('POST', '/login', [LoginController::class, 'login']);
    $r->addRoute('GET', '/forgotPassword', [ForgotPasswordController::class, 'showForm']);
    $r->addRoute('POST', '/forgotPassword', [ForgotPasswordController::class, 'login']);
    $r->addRoute('GET', '/profile', [UserProfileController::class, 'showForm']);
    $r->addRoute('POST', '/profile', [UserProfileController::class, 'yourProfile']);
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

            unset($_SESSION['errors']['name']);
            unset($_SESSION['errors']['surname']);
            unset($_SESSION['errors']['email']);
            unset($_SESSION['errors']['password']);
            unset($_SESSION['errors']['passwordConfirmation']);
        }

        if ($response instanceof Redirect) {
            header("Location: " . $response->getUrl());
        }
        // ... call $handler with $vars
        break;
}
?>
