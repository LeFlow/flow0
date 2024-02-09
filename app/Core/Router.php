<?php

namespace App\Core;

use App\Config\Config;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class Router
{
    private $routes;
    private $twig;
    private $middlewares = [];

    public function __construct($routes)
    {
        $this->routes = $routes;

        // Initialiser Twig
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function route($url, $request_method)
    {
        $config = new Config();
        $base_url = $config->getBaseUrl('base_url');

        foreach ($this->routes as $route => $params) {
            // Remplace les annotations dans la route par des regex
            $pattern = '#^' . preg_replace('#\{([\w]+)\}#', '([^/]+)', $route) . '$#';
            $url = $request_method . ' ' . substr_replace($_SERVER['REQUEST_URI'], '/', 0, strlen($base_url));

            if (preg_match($pattern, $url, $matches)) {
                // Supprime le premier élément qui contient l'URL complète
                array_shift($matches);

                // Appelle la méthode du contrôleur avec les paramètres
                list($controllerClass, $action) = $params;
                $controller = new $controllerClass($this->twig);

                // Rendre la vue en utilisant Twig
                echo $this->twig->render($action . '.twig' .$controller->$action(...$matches));
                return;
            }
        }
        // Si aucune route n'est trouvée, affiche la page 404
       echo $this->twig->render('404.twig');
    }

    public function registerMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }
}