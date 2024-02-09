<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
/*        
var_dump($_SESSION);
        if (!isset($_SESSION)){
            $admin = 'is_not_admin';
            $url = 'home.twig';
        }else{
            $admin = 'is_admin';
            $url = 'dashboard.twig';
        }

        $data = array(
            'admin' => $admin,
        ); // Vous pouvez ajouter des données ici si nécessaire
        return $this->render($url, $data);
*/        
        return $this->render('home.twig');

    }
}
