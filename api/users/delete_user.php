<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
// Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Users.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
//Instantiate users object
$users = new Users($db);
// //Get raw users data
// $data = json_decode(file_get_contents("php://input"));
//Get id user
$users->setId(isset($_GET['id']) ? $_GET['id'] : exit());
// //Find id user 
// if ($users->read_single()) {
//     //If there is a email verify, delete it
    

//     $verifys->setEmail($users->getEmail());
//     $result = $verifys->select_verify();
    
//     $num = $result->rowCount();
    
//     if ($num > 0) {
//         //Find email user not verification
//         // Delete row verify
//         $verifys->delete_verify();
//         if ($users->delete_user()) {
//             echo json_encode(
//                 array('message' => 'Delete Success')
//             );
//         } else {
//             echo json_encode(
//                 array('message' => 'Delete Failed')
//             );
//         }
//     }else{
//         //delete user
//         if ($users->delete_user()) {
//             echo json_encode(
//                 array('message' => 'Delete Success')
//             );
//         } else {
//             echo json_encode(
//                 array('message' => 'Delete Failed')
//             );
//         }
//     }
// }
//$users->id = $data->id;

//delete user
if ($users->delete_user()) {
    echo json_encode(
        array('message' => 'Delete Success')
    );
} else {
    echo json_encode(
        array('message' => 'Delete Failed')
    );
}
