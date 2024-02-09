<?php

namespace App\Controllers;

use App\Core\Session;
use App\Config\Config;
use App\Core\Redirect;
use App\Models\UserModel;
use App\Models\LoginModel;

class LoginController extends BaseController
{

    protected $userModel;
    protected $loginModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel(); // Initialisez votre modèle d'utilisateur ici
        $this->loginModel = new LoginModel();
    }

    public function loginForm()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        // Affichage du formulaire de connexion
        return $this->render('login.twig', ['base_url' => $base_url]);
    }

    public function login()
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $username = $_POST['usernameOrEmail'];
            $password = hash('sha256', $_POST['password']); // Hashage du mot de passe

            // Recherche de l'utilisateur dans la base de données par nom d'utilisateur
            $user = $this->loginModel->getUserByUsernameOrEmail($username);

            // Vérification du mot de passe
            if ($user && $user['password'] === $password) {
                // Authentification réussie, enregistrer les données de l'utilisateur en session
                Session::set('user', [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    // Autres données utilisateur que vous souhaitez enregistrer en session
                ]);

                // Redirection vers une page protégée ou vers le tableau de bord par exemple
                // Utilisez la fonction redirect si vous avez une classe Redirect ou redirigez directement avec header
                header('Location:' . $base_url . 'admin');
                exit;
            } else {
                // Identifiants incorrects, affichage d'un message d'erreur par exemple
                // Vous pouvez passer un message d'erreur à la vue pour l'afficher
                $errorMessage = "Identifiants incorrects. Veuillez réessayer.";
                return $this->render('login.twig', ['error' => $errorMessage]);
            }
        } else {
            // Requête non autorisée, rediriger vers la page de connexion
            // header('Location: /login');
            // exit;
        }
    }

    public function logout()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        // Déconnexion : suppression des données de session utilisateur
        Session::remove('user');

        $data = array(
            'base_url' => $base_url,
            'admin' => 'is_nt_authenticated'
        );

        // Redirection vers la page d'accueil ou une autre page après la déconnexion
        return $this->render('home.twig', $data);
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
