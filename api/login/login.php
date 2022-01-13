<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../config/Database.php';
    include_once '../../models/Users.php';
    include_once '../../models/Verify.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate users object
    $users = new Users($db);
    $verify = new Verify($db);

    //Get raw users data
    $data = json_decode(file_get_contents("php://input"));

    $users->setEmail($data->email);
    

    //get user 
    $result = $users->login();
    // print_r($result);

    //Get row count
    $num = $result->rowCount();
    //Check if any users
    if($num > 0){
        //Users array
        $users_arr = array();
        $users_arr['data'] = array();
        $login = 0;

        //-------------------Login------------
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //fetch(PDO::FETCH_ASSOC)): Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
            // echo "rowww: id : $id";
            extract($row);//Gọp các biến từ khác thành một mảng
            // echo "rowwwwwww: id : $id";
            if (password_verify($data->password, $password)){
                $login = 1;
            }
            if ($created_at == null){
                $login = 2;
            }
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
        
        if($login == 1){
             //Turn to JSON $ output
            echo json_encode($users_arr);

        }elseif($login == 2){
            echo json_encode(
                array('message' => 'Email not verified')
            );
        }else{
            echo json_encode(
                array('message' => 'Invalid password')
            );
        }
    } else {
        //No users
        echo json_encode(
            array('message' => 'Invalid email and password')
        );

    }

