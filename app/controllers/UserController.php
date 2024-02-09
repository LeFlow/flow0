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
        
        $userData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => $_POST['role']
        ];

        $this->userModel->create($userData);

        echo $this->twig->render('admin_user/userAdded.twig', ['base_url' => $base_url]);

    }

    public function updateUserForm($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();

        $user = $this->userModel->getUserById($id);

        $data = array(
            'user' => $user,
            'base_url' => $base_url
        );

        echo $this->twig->render('admin_user/updateUserForm.twig', $data);
    }

    public function update($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();

        $userData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => $_POST['role'],
        ];

        $this->userModel->update($id, $userData, $base_url);

        echo $this->twig->render('admin_user/userAdded.twig', ['base_url' => $base_url]);
    }

    public function deleteUserConfirmation($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();
 
        $user = $this->userModel->getUserById($id);
        $data = array(
            'user' => $user, 
            'base_url' => $base_url
        );

        echo $this->twig->render('admin_user/deleteUserConfirmation.twig', $data);
    }

    public function delete($id)
    {
        $config = new Config;
        $base_url = $config->getBaseUrl();

        $this->userModel->delete($id);

        header("Location:" . $base_url . "admin");
        exit;
    }
}