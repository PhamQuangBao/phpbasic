<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
// Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Verify.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate users object
$verify = new Verify($db);

//Get raw users data
$data = json_decode(file_get_contents("php://input"));

$verify->setEmail($data->email);

//creart user
if ($verify->create_verify()) {
    echo json_encode(
        array('message' => 'Verify Created')
    );
} else {
    echo json_encode(
        array('message' => 'Verify Failed')
    );
}
