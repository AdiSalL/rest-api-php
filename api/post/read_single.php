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
//Get Id

$post->id = isset($_GET["id"]) ? $_GET["id"] : die();

if( $post->readSingle()) {
    $post_arr = array(
        "id" => $post->id,
        "title" => $post->title,
        "body" => $post->body,
        "author" => $post->author,
        "category_id" => $post->category_id,
        'category_name' => $post->category_name
    );
    
print_r(json_encode($post_arr));
}else {
    print_r(json_encode(array("message" => "No post found")));
}



//make JSON
