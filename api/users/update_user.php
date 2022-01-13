<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    //Set id user to update
    // $users->id = $data->id;

    // $users->name = $data->name;
    // $users->phone = $data->phone;
    // $users->email = $data->email;
    // $users->gender = $data->gender;
    // $users->date_birth = $data->date_birth;
    // $users->address = $data->address;
    // $users->created_at = $data->created_at;
    // $users->updated_at = $data->updated_at;

    $users->setId($data->id);
    
    $users->setName($data->name);
    $users->setPhone($data->phone);
    $users->setEmail($data->email);
    $users->setGender($data->gender);
    $users->setDate_birth($data->date_birth);
    $users->setAddress($data->address);
    $users->setCreated_at($data->created_at);
    $users->setUpdated_at($data->updated_at);

    //creart user
    if($users->update_user()){
        echo json_encode(
            array('message' => 'Update Success')
        );
    }else{
        echo json_encode(
            array('errors' => 'Update Failed')
        );
    }