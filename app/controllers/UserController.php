<?php

namespace App\Controllers;

use App\Config\Config;
use Twig\Environment;
use App\Models\UserModel;

class UserController extends BaseController
{
    private $userModel;
    protected $twig;

    public function __construct(Environment $twig)
    {
        $userModel = new UserModel;
        $this->userModel = $userModel;
        $this->twig = $twig;
    }

    public function addUserForm()
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        echo $this->twig->render('admin_user/addUserForm.twig', ['base_url' => $base_url]);
    }

    public function addUser()
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        // Récupérer les données du formulaire
        $userData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => $_POST['role'],
            // Ajoutez d'autres champs ici
        ];

        // Ajouter un utilisateur
        $this->userModel->create($userData);

        echo $this->twig->render('admin_user/userAdded.twig', ['base_url' => $base_url]);

    }

    public function updateUserForm($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        // Récupérer les données de l'utilisateur à modifier
        $user = $this->userModel->getUserById($id);

        $data = array(
            'user' => $user,
            'base_url' => $base_url
        );
        // Afficher le formulaire de modification avec les données de l'utilisateur
        echo $this->twig->render('admin_user/updateUserForm.twig', $data);
    }

    public function update($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        // Récupérer les données du formulaire
        $userData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => $_POST['role'],
        ];

        // Mettre à jour l'utilisateur
        $this->userModel->update($id, $userData, $base_url);

        // Rediriger vers la liste des utilisateurs
        header("Location:" . $base_url . "admin");
        exit;
    }

    public function deleteUserConfirmation($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        // Récupérer les données de l'utilisateur à supprimer
        $user = $this->userModel->getUserById($id);
        $data = array(
            'user' => $user, 
            'base_url' => $base_url
        );

        // Afficher la confirmation de suppression avec les données de l'utilisateur
        echo $this->twig->render('admin_user/deleteUserConfirmation.twig', $data);
    }

    public function delete($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        // Supprimer l'utilisateur
        $this->userModel->delete($id);

        // Rediriger vers la liste des utilisateurs
        header("Location:" . $base_url . "admin");
        exit;
    }
}
