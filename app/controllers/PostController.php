<?php

namespace App\Controllers;

use Twig\Environment;
use App\Config\Config;
use App\Models\PostModel;

class PostController extends BaseController
{
    private $postModel;
    protected $twig;

    public function __construct(Environment $twig)
    {
        $postModel = new PostModel;
        $this->postModel = $postModel;
        $this->twig = $twig;
    }

    public function createPostForm()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        echo $this->twig->render('posts/addPostForm.twig', ['base_url' => $base_url]);
    }

    public function createPost()
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        $postData = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author_id' => 1 //$_POST['author_id']
        ];

        $this->postModel->create($postData);

        echo $this->twig->render('admin_user/userAdded.twig', ['base_url' => $base_url]);
    }

    public function updatePostForm($id)
    {
        $config = new Config();
        $base_url = $config->getBaseUrl();
        $post = $this->postModel->getById($id);
        $data = array(
            'post' => $post,
            'base_url' => $base_url
        );
        echo $this->twig->render('posts/updatePostForm.twig', $data);
    }

    public function updatePost($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        $postData = [
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ];

        $this->postModel->update($id, $postData);

        header("Location:" . $base_url . "admin");
        exit;
    }

    public function deletePostConfirmation($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        $post = $this->postModel->getById($id);
        $data = array(
            'post' => $post,
            'base_url' => $base_url
        );
        echo $this->twig->render('posts/deletePostConfirmation.twig', $data);
    }

    public function deletePost($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
        $this->postModel->delete($id);

        header("Location:" . $base_url . "admin");
        exit;
    }
}
