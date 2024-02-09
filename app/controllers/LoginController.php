<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\UserModel;
use Twig\Environment;


class LoginController extends BaseController
{
    private $loginModel;
    protected $twig;
    private $userModel;

    public function __construct(Environment $twig)
    {
        $this->loginModel = new LoginModel();
        $this->twig = $twig;
    }

    public function loginForm()
    {
        // Afficher le formulaire de connexion
        if (!isset($_SESSION)){
            echo $this->twig->render('login.twig');
        }else{
            echo $this->twig->render('admin.twig');
        }
        
    }

    public function login()
    {
        session_start();
        // Récupérer les données du formulaire de connexion
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $password = $_POST['password'];

        // Récupérer l'utilisateur par nom d'utilisateur ou adresse e-mail
        $user = $this->loginModel->getUserByUsernameOrEmail($usernameOrEmail);
var_dump($user);
        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && hash('sha256', $password) == $user['password'] && $user['role'] === 'administrateur') {
            // Authentification réussie, enregistrer les informations dans la session
            $_SESSION['user'] = $user;
            var_dump($user);

            // Rediriger vers le tableau de bord
            header("Location: /flow/admin");
            exit;
        } else {
            // Authentification échouée, afficher un message d'erreur
            echo $this->twig->render('login.twig', ['error' => 'Identifiants incorrects']);
        }
    }

    public function logout()
    {
        // Déconnexion de l'utilisateur, détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        //header("Location: /flow/");
        //exit;
        echo $this->twig->render('flow/', ['is_not_admin' => 'is_not_admin']);
    }

    public function checkIfUserIsAdmin()
    {
        // Vérifiez si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Récupérez les informations sur l'utilisateur depuis la base de données
            $user = $this->userModel->getUserById($userId);

            // Vérifiez si l'utilisateur est un administrateur
            if ($user && $user['role'] === 'admin') {
                return true;
            }
        }
        
        return false;
    }
}
