<?php
namespace App\Controllers;

use App\models\PostModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $postModel = new PostModel();
        $posts = $postModel->getAll();

        $userModel = new UserModel();
        $users = $userModel->getAll();

        $data = array(
            'posts' => $posts,
            'users' => $users
        );
        
 
        return $this->render('home.twig', $data);

    }
}