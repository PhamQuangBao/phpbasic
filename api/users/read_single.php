<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate users object
    $users = new Users($db);

    //Get id user
    $users->setId(isset($_GET['id']) ? $_GET['id'] : exit()); //die()
    
    //get user single   
    $users->read_single();

    $users_arr1['data'] = array();

    //Create array
    $users_arr = array(
        'id' => $users->getId(),
        'name' => $users->getName(),
        'phone' => $users->getPhone(),
        'email' => $users->getEmail(),
        'gender' => $users->getGender(),
        'date_birth' => $users->getDate_birth(),
        'address' => $users->getAddress(),
        'created_at' => $users->getCreated_at(),
        'updated_at' => $users->getUpdated_at(),
    );

    //Pust to "data"
    //array_push($users_arr1['data'], $users_arr);

    //parse json
    //Turn to JSON $ output
    echo json_encode($users_arr);
