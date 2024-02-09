<?php

namespace App\Models;

use App\Config\Database;

class BaseModel
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function query($sql, $params = [])
    {
        // Exécute une requête SELECT
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public function execute($sql, $params = [])
    {
        // Exécute une requête qui ne retourne pas de résultats (INSERT, UPDATE, DELETE, etc.)
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    protected function getSingleResult($sql, $params = [])
    {
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetch();
    }


    // Ajoute d'autres méthodes CRUD en fonction de tes besoins
}
