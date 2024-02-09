<?php
namespace App\models;

class PostModel extends BaseModel
{
    protected $table = 'posts';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPosts()
    {
        return $this->getAll();
    }

    public function getPostByID($id)
    {
        return $this->getById($id);
    }

    public function create($postData)
    {
        $sql = "INSERT INTO {$this->table} (title, content, author_id, creation_date) VALUES (?, ?, ?, NOW())";
        $params = [$postData['title'], $postData['content'], $postData['author_id']];
        $this->execute($sql, $params);
        return $this->db->lastInsertId();
    }

    public function update($id, $postData)
    {
        $sql = "UPDATE {$this->table} SET title = ?, content = ? WHERE id = ?";
        $params = [$postData['title'], $postData['content'], $id];
        $this->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->execute($sql, [$id]);
    }
}

