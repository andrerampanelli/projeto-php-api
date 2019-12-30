<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../Config/Database.php';
require __DIR__ . '/../Models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->email) &&
    !empty($data->password)
) {

    $password = sha1($data->password);

    $user->auth($data->email);

    if ($password == $user->password) {
        echo json_encode(array("message" => "Logged In"));
        http_response_code(200);
    } else {
        echo json_encode(array("message" => "Something went wrong. Password or email not found. "));
        http_response_code(401);
    }
} else {
    echo json_encode(array("message" => "A email and password must be present."));
    http_response_code(404);
}
