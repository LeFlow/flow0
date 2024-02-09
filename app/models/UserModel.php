<?php
namespace App\Models;

class UserModel extends BaseModel
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById($id)
    {
        return $this->getById($id);
    }

    public function create($userData)
    {
        $sql = "INSERT INTO {$this->table} (username, email, password, role) VALUES (?, ?, ?, ?)";
        $params = [$userData['username'], $userData['email'], hash('sha256', $userData['password']), $userData['role']];
        $this->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $userData)
    {
        $sql = "UPDATE {$this->table} SET username = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $params = [$userData['username'], $userData['email'], hash('sha256', $userData['password']), $userData['role'], $id];
        $this->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->execute($sql, [$id]);
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $params = [$username];
        $this->execute($sql, $params);
        return $this->db->lastInsertId();
    }
}