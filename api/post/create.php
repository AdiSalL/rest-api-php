<?php
//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


require_once  '../../config/Database.php';
require_once  '../../models/Post.php';

use Config\Database;
use Models\Post;

//instantiate DB and connect

$database = new Database();
$post = new Post($database);