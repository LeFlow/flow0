<?php

use App\Core\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Middleware\AuthMiddleware;

require __DIR__ . '/vendor/autoload.php';

// Démarrage de la session
session_start();

// Chargement des routes
$routes = require __DIR__ . '/app/config/routes.php';

// Instanciation du routeur
$router = new Router($routes);

// Configuration de Twig
$loader = new FilesystemLoader(__DIR__ . '/app/views');
$twig = new Environment($loader);

// Enregistrement du middleware d'authentification
$router->registerMiddleware(new AuthMiddleware());

// Récupération de la méthode de la requête HTTP
$request_method = $_SERVER['REQUEST_METHOD'];

// Récupération de l'URI demandée
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Supprime la partie de l'URL après le point d'interrogation (si présente)
$url = strtok($url, '?');

try {
    // Routage de la demande vers le bon contrôleur et l'action correspondante
    $router->route($url, $request_method);
} catch (Exception $e) {
    // Gestion des erreurs
    // Ici, vous pouvez loguer l'erreur, afficher une page d'erreur personnalisée, etc.
    echo "Une erreur s'est produite : " . $e->getMessage();
}
