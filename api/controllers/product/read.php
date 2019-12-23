<?php

// namespace Api\controllers\product\read;

require __DIR__ . '/../../Config/Database.php';
require __DIR__ . '/../../Models/Product.php';

// use Api\Config\Database;
// use Api\Models\Product;
// use PDO;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$db = Database::getInstance();
$conn = $db->getConnection();

$product = new Product($conn);

$stmt = $product->read();
$num = $stmt->rowCount();

if ($num > 0) {

    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        array_push($products_arr["records"], $product_item);
    }

    http_response_code(200);

    echo json_encode($products_arr);
} else {

    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}
