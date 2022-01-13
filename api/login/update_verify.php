<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../config/Database.php';
include_once '../../models/Verify.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate users object
$verifys = new Verify($db);

$data = json_decode(file_get_contents("php://input"));

$verifys->setEmail($data->email);

if($verifys->update_verify()){
    echo json_encode(
        array('message' => 'Update verify Success')
    );
}else{
    echo json_encode(
        array('errors' => 'Update verify Failed')
    );
}
