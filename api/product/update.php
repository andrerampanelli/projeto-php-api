<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../Config/Database.php';
require __DIR__ . '/../Models/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$product->id = $data->id;

$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;

if ($product->update()) {
    echo json_encode(array("message" => "Product was updated."));
    http_response_code(200);
} else {
    echo json_encode(array("message" => "Unable to update product."));
    http_response_code(503);
}
