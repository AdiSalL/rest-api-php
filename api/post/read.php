<?php
//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once  '../../config/Database.php';
require_once  '../../models/Post.php';

use Config\Database;
use Models\Post;

//instantiate DB and connect

$database = new Database();
$post = new Post($database);

//Blog Post query
$result = $post->read();

//get row count
$num = $result->rowCount();

if($num > 0) {
    //Post array
    $posts_arr = array();
    $posts_arr["data"] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array (
            "id" => $id,
            "title" => $title,
            "body" => html_entity_decode($body),
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name,
        );
        //push to "data"
        array_push($posts_arr["data"], $post_item);
    }

    echo json_encode($posts_arr);
} else {
    echo json_encode(
        array("message" => "No posts Found")
    );
}
