<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    // Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    
    //
    

    //Get raw users data
    $data = json_decode(file_get_contents("php://input"), true);

    //var_dump()sẽ in ra thông tin của biến gồm kiểu dữ liệu của biến và giá trị.

    
    $image = $data['image'];
    $path = "../../storage/app/public/". $data['name'];
    
    $result = file_put_contents($path, base64_decode($image));
    if($result){
        echo json_encode(
            array('message' => 'Upload image Sussces')
        ); 
    }else{
        echo json_encode(
            array('message' => 'Upload image Failed')
        );
    }
    // $path = "../../storage/app/public/". $data->image->postname;
    // echo "path  :" , $path;
    // move_uploaded_file( $data->image->name , $path);

    // if(isset($_FILES['image']['tmp_name'])){
    //     $path = "../../storage/app/public/" . $_FILES['image']['name'];
    //     echo "data      " , $_FILES['image']['tmp_name'];
    //     //move_uploaded_file($_FILES['image']['tmp_name'], $path);
    // }
