<?php
// loader.php

spl_autoload_register(function ($className) {
    // Convertit les barres obliques inverses en barres obliques
    $className = str_replace('\\', '/', $className);

    // Supprime le préfixe 'App/' car il est déjà inclus dans le chemin
    $className = str_replace('App/', '', $className);

    // Ajoute le chemin de base du projet
    $className = 'App/' . $className;

    // Ajoute l'extension .php
    $className = $className . '.php';
    // Vérifie si le fichier existe avant de l'inclure
    if (file_exists($className)) {
        require_once $className;
    } else {
        die("Fichier $className introuvable.");
    }
});
