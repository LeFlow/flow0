<?php
namespace App\Controllers;

use Twig\TwigFilter;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Twig\Extra\Intl\IntlExtension;
use Psr\Container\ContainerInterface;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class BaseController
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../views');

        try {
            $this->twig = new Environment($loader, [
                'debug' => true,
                'autoescape' => false, // Désactivez l'échapement automatique des chaînes HTML
                'optimizations' => -1, // Activer les optimisations complètes (-1 signifie autodétection)
            ]);

            // Charger les fonctions et filtres personnalisés
            require __DIR__ . '/../../functions.php';
            foreach ($GLOBALS['twigFunctions'] as $function) {
                $this->twig->addFunction($function);
            }

            foreach ($GLOBALS['twigFilters'] as $filter) {
                $this->twig->addFilter($filter);
            }

            // Ajouter l'extension Intl
            $intlExtension = new IntlExtension();
            $this->twig->addExtension($intlExtension);

            // Ajouter un runtime loader pour gérer les objets intégrés
            $runtimeLoader = new FactoryRuntimeLoader([
                \App\Services\SessionService::class => function () {
                    return new \App\Services\SessionService();
                },
            ]);

            $this->twig->addRuntimeLoader($runtimeLoader);

        } catch (LoaderError $e) {
            die('Erreur de chargement de Twig: ' . $e->getMessage());
        }

        $runtimeLoader = new FactoryRuntimeLoader([
            \App\Services\SessionService::class => function ($container) {
                return new \App\Services\SessionService();
            },
        ]);
        
        $this->twig->addRuntimeLoader($runtimeLoader);
    }

    public function render($view, $data = []): string
    {
        return $this->twig->render($view, $data);
    }

    protected function error404(): void
    {
        http_response_code(404); // Définir le statut HTTP à 404
        $this->render('error/404');
        exit();
    }

}