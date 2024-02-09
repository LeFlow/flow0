<?php

use App\Models\UserModel;

// Validation des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Nouveau champ de rôle

    // Instanciation du modèle UserModel
    $userModel = new UserModel();

    // Ajout de l'utilisateur dans la base de données avec le rôle
    $userModel->create($username, $password, $email, $role);

    // Redirection vers le tableau de bord après l'ajout de l'utilisateur
    header('Location: /dashboard');
    exit();
}
