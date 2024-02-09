<?php

namespace App\Controllers;

use Twig\Environment;
use App\models\PostModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    private $userModel;
    protected $twig;
    protected $postModel;

    public function __construct(Environment $twig)
    {
        $this->userModel = new UserModel();
        $this->twig = $twig;
    }

    public function index()
    {

       // $username = $_SESSION['user']['username']; // Supposons que 'username' est la clé où vous stockez le nom d'utilisateur


        if(!isset($_SESSION['user'])){
            $admin = 'is_authenticated';
            echo $this->twig->render('home.twig', ['admin' => $admin]);
        }
            
            $userModel = new UserModel();
            $postModel = new PostModel();
            
            $users = $userModel->getAll();
            $posts = $postModel->getAll();
    
            $data = array(
                'users' => $users,
                'posts' => $posts,
                //'user'=> $username
            );
            echo $this->twig->render('dashboard.twig', $data);
//        }

    }
}
