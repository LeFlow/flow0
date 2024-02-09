<?php

use App\Core\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Middleware\AuthMiddleware;

require __DIR__ . '/vendor/autoload.php';

session_start();

$routes = require __DIR__ . '/app/config/routes.php';

$router = new Router($routes);

$loader = new FilesystemLoader(__DIR__ . '/app/views');
$twig = new Environment($loader);

$router->registerMiddleware(new AuthMiddleware());

$request_method = $_SERVER['REQUEST_METHOD'];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$url = strtok($url, '?');

try {
    $router->route($url, $request_method);
} catch (Exception $e) {
    echo "Une erreur s'est produite : " . $e->getMessage();
}
