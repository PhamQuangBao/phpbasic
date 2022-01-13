<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Verify.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate users object
    $verifys = new Verify($db);

    //Get name user
    // $users->name = isset($_GET['name']) ? $_GET['name'] : exit(); //die()

    $verifys->setEmail(isset($_GET['email']) ? $_GET['email'] : exit());

    //get user search
    $result = $verifys->select_verify();
    // print_r($result);

    //Get row count
    $num = $result->rowCount();

    //Check if any users
    if($num > 0){
        //Users array
        $verifys_arr = array();
        $verifys_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //fetch(PDO::FETCH_ASSOC)): Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
            extract($row);//Gọp các biến từ khác thành một mảng
            
            $verifys_item = array(
                'id' => $id,
                'email' => $email,
                'code' => $code,
                'created_at' => $created_at,
            );
            
            //Pust to "data"
            array_push($verifys_arr['data'], $verifys_item);
        }
            //Turn to JSON $ output
            echo json_encode($verifys_arr);
    } else {
        //No users
        echo json_encode(
            array('message' => 'No Verify')
        );

    }

