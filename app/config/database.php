<?php
namespace App\Config;

class Database {
    private $host = 'localhost';
    private $dbname = 'sitechat';
    private $username = 'root';
    private $password = 'asmin';

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $db = new \PDO($dsn, $this->username, $this->password, $options);
            return $db;
        } catch (\PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}

// admin en sha256 = 8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918	