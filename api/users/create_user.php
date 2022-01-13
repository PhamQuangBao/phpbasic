<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    // Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate users object
    $users = new Users($db);

    //Get raw users data
    $data = json_decode(file_get_contents("php://input"));

    $users->setName($data->name);
    $users->setPhone($data->phone);
    $users->setEmail($data->email);
    $users->setPassword($data->password);
    $users->setGender($data->gender);
    $users->setDate_birth($data->date_birth);
    $users->setAddress($data->address);
    $users->setCreated_at($data->created_at);
    $users->setUpdated_at($data->updated_at);

    //Check if users exists
    $result = $users->select_user_email_phone();
    //Get row count
    $num = $result->rowCount();
    
    if($num > 0){
        echo json_encode(
            array('message' => 'Phone or email already in use')
        );
    }
    else{
        //creart user
        if($users->create_user()){
            echo json_encode(
                array('message' => 'User Created')
            );
        }else{
            echo json_encode(
                array('message' => 'Created Failed')
            );
        }
    }
    
    