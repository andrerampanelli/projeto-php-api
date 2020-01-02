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

if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id)
) {
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = date('Y-m-d H:i:s');

    if ($product->create()) {
        echo json_encode(array("message" => "Product was created."));
        http_response_code(201);
    } else {
        echo json_encode(array("message" => "Unable to create product."));
        http_response_code(503);
    }
} else {
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    http_response_code(400);
}
