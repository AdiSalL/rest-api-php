<?php
namespace Models;

use Config\Database;

class Category {
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $created_at;

    public function __construct(Database $db) {
        $this->conn = $db->connect();
    }

    public function read() {
        $query = "SELECT * FROM categories";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //get single post

}
