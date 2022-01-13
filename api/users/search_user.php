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

    //Get name user
    // $users->name = isset($_GET['name']) ? $_GET['name'] : exit(); //die()

    $users->setName(isset($_GET['name']) ? $_GET['name'] : exit());

    //get user search
    $result = $users->search_user_name();
    // print_r($result);

    //Get row count
    $num = $result->rowCount();

    //Check if any users
    if($num > 0){
        //Users array
        $users_arr = array();
        $users_arr['data'] = array();
        

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //fetch(PDO::FETCH_ASSOC)): Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
            extract($row);//Gọp các biến từ khác thành một mảng
            
            $user_item = array(
                'id' => $id,
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'gender' => $gender,
                'date_birth' => $date_birth,
                'address' => $address,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            );
            
            //Pust to "data"
            array_push($users_arr['data'], $user_item);
        }
            //Turn to JSON $ output
            echo json_encode($users_arr);
    } else {
        //No users
        echo json_encode(
            array('message' => 'No Users')
        );

    }

