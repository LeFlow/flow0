<?php
namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request)
    {
         if (!isset($_SESSION['user'])) {
             header('Location: /login');
            exit;
        }
        
         return $request;
    }
}