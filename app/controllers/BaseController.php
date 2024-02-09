<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController {
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);
    }

    public function render($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $twig = new \Twig\Environment($loader);
        echo $twig->render($view, $data);
    }
    
    protected function error404() {
        $this->render('404');
        exit();
    }
}