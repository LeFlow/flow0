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
                'posts' => $posts
            );
            echo $this->twig->render('dashboard.twig', $data);
    }
}