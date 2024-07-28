<?php
//Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once  '../../config/Database.php';
require_once  '../../models/Category.php';

use Config\Database;
use Models\Category;

//instantiate DB and connect

$database = new Database();
$category = new Category($database);

//Blog  query
$result = $category->read();

//get row count
$num = $result->rowCount();

if($num > 0) {
    //category array
    $categorys_arr = array();
    $categorys_arr["data"] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category_item = array (
            "id" => $id,
            "name" => $name,
        );
        //push to "data"
        array_push($categorys_arr["data"], $category_item);
    }

    echo json_encode($categorys_arr);
} else {
    echo json_encode(
        array("message" => "No categorys Found")
    );
}
