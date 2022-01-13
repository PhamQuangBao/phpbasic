<?php

require_once ROOT_PATH . '\utils\utils.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}



switch ($action) {
    //---------------------------------------------------------------------------
    case 'upload':
        if(isset($_FILES['upload-image']['tmp_name'])){
            $url_upload_image = PATH_API . "/api/upload/upload_image.php";
            
            $name_image = $_FILES['upload-image']['name'];
            $type_image = $_FILES['upload-image']['type'];
            $data = file_get_contents($_FILES['upload-image']['tmp_name']);
            $data_image = base64_encode($data);


            $sent_data = array(
                'name' => $name_image,
                'image' => $data_image,
                'type' => $type_image
            );

            //callAPI
            $login_user = callAPI('POST', $url_upload_image, json_encode($sent_data));
            
            $response = json_decode($login_user, true);

            echo $response['message'];

        }

        require_once('view/uploadfile/uploads.php');
        break;
    
}