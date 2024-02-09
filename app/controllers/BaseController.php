<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController {
    protected $twig;

    public function __construct()
    {
        // Créer un chargeur de fichiers pour Twig
        $loader = new FilesystemLoader(__DIR__ . '/../views');

        // Créer l'environnement Twig
        $this->twig = new Environment($loader);
    }

    public function render($view, $data = []) {
        // Initialisation de Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $twig = new \Twig\Environment($loader);

        // Rendu de la vue avec Twig
        echo $twig->render($view, $data);
    }
    
    protected function error404() {
        // Afficher une page d'erreur 404
        $this->render('404');
        exit();
    }
}
