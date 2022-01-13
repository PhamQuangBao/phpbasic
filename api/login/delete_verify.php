<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/Database.php';
include_once '../../models/Verify.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate users object
$verifys = new Verify($db);

$verifys->setEmail(isset($_GET['email']) ? $_GET['email'] : exit());

// $aa = $verifys->getEmail();
// echo"$aa";
if ($verifys->delete_verify()) {
    echo json_encode(
        array('message' => 'Delete Success')
    );
} else {
    echo json_encode(
        array('message' => 'Delete Failed')
    );
}

