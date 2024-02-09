<?php
namespace App\Controllers;

use App\Core\Session;
use App\Config\Config;
use App\Models\UserModel;
use App\Models\LoginModel;

class LoginController extends BaseController
{

    protected $userModel;
    protected $loginModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->loginModel = new LoginModel();
    }

    public function loginForm()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        return $this->render('login.twig', ['base_url' => $base_url]);
    }

    public function login()
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['usernameOrEmail'];
            $password = hash('sha256', $_POST['password']);

            $user = $this->loginModel->getUserByUsernameOrEmail($username);

            if ($user && $user['password'] === $password) {
                Session::set('user', [
                    'id' => $user['id'],
                    'username' => $user['username'],
                ]);

                header('Location:' . $base_url . 'admin');
                exit;
            } else {
                $errorMessage = "Identifiants incorrects. Veuillez réessayer.";
                return $this->render('login.twig', ['error' => $errorMessage]);
            }
        }
    }

    public function logout()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();

        Session::remove('user');

        $data = array(
            'base_url' => $base_url,
            'admin' => 'is_nt_authenticated'
        );

        return $this->render('home.twig', $data);
    }

    public function checkIfUserIsAdmin()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $user = $this->userModel->getUserById($userId);

            if ($user && $user['role'] === 'admin') {
                return true;
            }
        }
        
        return false;
    }
}