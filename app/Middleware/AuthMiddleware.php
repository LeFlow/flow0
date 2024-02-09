<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!isset($_SESSION['user'])) {
            // Rediriger vers la page de connexion
            header('Location: /login');
            exit;
        }
        
        // Si l'utilisateur est authentifié, laissez la requête passer
        return $request;
    }
}
