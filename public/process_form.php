<?php

use App\Models\UserModel;

// Validation des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $userModel = new UserModel();

    $userModel->create($username, $password, $email, $role);

    header('Location: /dashboard');
    exit();
}