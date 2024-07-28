<?php
namespace Models;

use Config\Database;

class Post {
    private $conn;
    private $table = 'posts';

    public function __construct(Database $db) {
        $this->conn = $db->connect();
    }

    public function read() {
        $query = "SELECT 
            categories.name as category_name,
            posts.id,
            posts.category_id,
            posts.title,
            posts.body,
            posts.author,
            posts.created_at 
            FROM  posts LEFT JOIN categories ON posts.category_id = categories.id
            ORDER BY posts.created_at ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //get single post

    public function readSingle() {
        $query = "SELECT 
        categories.name as category_name,
        posts.id,
        posts.category_id,
        posts.title,
        posts.body,
        posts.author,
        posts.created_at 
        FROM  posts LEFT JOIN categories ON posts.category_id = categories.id
        WHERE posts.id = ? LIMIT 0,1";

        //prepare statement
        
        $stmt = $this->conn->prepare($query);
        //Bind ID Param
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if($row) {
            $this->title = $row["title"];
            $this->body = $row["body"];
            $this->author = $row["author"];
            $this->created_at = $row["created_at"];
            $this->category_id = $row["category_id"];
            $this->category_name = $row["category_name"];
            return true;
        }
        return false;
    }

    public function create(){
        $query = "INSERT INTO SET posts title = :title, 
        body = :body,
        author = :author,
        category_id = :category_id,";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        
        if($stmt->execute()) {
            return true;
        }   
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
