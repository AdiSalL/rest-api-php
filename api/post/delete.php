<?php

//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


require_once  '../../config/Database.php';
require_once  '../../models/Post.php';

use Config\Database;
use Models\Post;

//instantiate DB and connect

$database = new Database();
$post = new Post($database);

//Get raw posted data

$data = json_decode(file_get_contents("php://input"));

//
$post->id = $data->id;



//Delete post
if($post->delete()) {
    echo json_encode(
        array(
            "message" => "Post Deleted"
        )
    );
}else {
    echo json_encode(
        array(
            "message" => "Post Failed To Got Deleted"
        )
    );
}
