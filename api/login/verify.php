<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../config/Database.php';
include_once '../../models/Verify.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate users object
$verifys = new Verify($db);

$data = json_decode(file_get_contents("php://input"));

$verifys->setEmail($data->email);
$verifys->setCode($data->code);
// $aa = $verifys->getEmail();
// echo"$aa";
$result = $verifys->select_verify();

$num = $result->rowCount();
if ($num > 0) {
    $check_vali = 0;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        if (password_verify($data->code, $code)) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            //Set time for code verification
            $minute_add = 2;

            $checktime = new DateTime($row['created_at']);
            $checktime->add(new DateInterval('PT' . $minute_add . 'M'));

            $timenow = new DateTime(date("Y-m-d H:i:s"));
            if($checktime > $timenow){
                
                $check_vali = 1;
            }else{
                
                $check_vali = 2;
            }
        }
    }
    if ($check_vali == 1) {
        if ($verifys->update_user()) {
            $verifys->delete_verify();
            echo json_encode(
                array('message' => 'Update verify user Success')
            );
        } else {
            echo json_encode(
                array('message' => 'Update verify user Failed')
            );
        }
    } 
    elseif ($check_vali == 2) {
        echo json_encode(
            array('message' => 'Code confirmation time late')
        );
    } else {
        echo json_encode(
            array('message' => 'Invalid verification code')
        );
    }
}
