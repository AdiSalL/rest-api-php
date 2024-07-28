<?php

//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
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

$post->title = $data->title;
$post->body = $data->body ;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Update post
if($post->update()) {
    echo json_encode(
        array(
            "message" => "Post Updated"
        )
    );
}else {
    echo json_encode(
        array(
            "message" => "Post Failed To Update"
        )
    );
}
