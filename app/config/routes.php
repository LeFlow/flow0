<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Controllers\DashboardController;
use App\Controllers\LoginController;

// Définition des routes
$routes = [
    'GET /' => [HomeController::class, 'index'],
    // Routes pour l'interface d'administration
    'GET /admin' => [DashboardController::class, 'index'],

    // Routes pour la gestion de la connexion
    'GET /login' => [LoginController::class, 'loginForm'],
    'POST /login' => [LoginController::class, 'login'],
    'GET /logout' => [LoginController::class, 'logout'],
    // user routes
    'GET /user/create' => [UserController::class, 'addUserForm'],
    'POST /user/add' => [UserController::class, 'addUser'],
    'GET /user/{id}/edit' => [UserController::class, 'updateUserForm'],
    'POST /user/{id}/update' => [UserController::class, 'update'],
    'POST /user/{id}/delete' => [UserController::class, 'deleteUserConfirmation'],
    'POST /user/delete/{id}' => [UserController::class, 'delete'],
    // post routes
    'GET /post/create' => [PostController::class, 'createPostForm'],
    'POST /post' => [PostController::class, 'createPost'],
    'GET /post/{id}/edit' => [PostController::class, 'updatePostForm'],
    'POST /post/{id}' => [PostController::class, 'updatePost'],
    'POST /post/{id}/delete' => [PostController::class, 'deletePostConfirmation'],
    'POST /post/delete/{id}' => [PostController::class, 'deletePost']
];

return $routes;
