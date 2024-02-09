<?php

namespace App\Models;

use App\Config\Database;

class LoginModel extends BaseModel
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByUsernameOrEmail($usernameOrEmail)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = ? OR email = ?";
        return $this->getSingleResult($sql, [$usernameOrEmail, $usernameOrEmail]);
    }
}
