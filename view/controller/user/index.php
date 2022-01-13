<?php

require_once ROOT_PATH . '\utils\utils.php';


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}



switch ($action) {
        //---------------------------------------------------------------------------

    case 'insert':


        $error = array();
        $data = array();
        $check_response_insert = 0;
        if (isset($_POST['add_user'])) {
            $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
            //
            //$data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
            if (isset($_POST['phone'])) {
                $string = $_POST['phone'];
                if (validation_phone($string)) {
                    $data['phone'] = $string;
                } else {
                    $error['phone'] = 'Only number and 10 characters';
                }
            }
            //
            //$data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
            if (isset($_POST['email'])) {
                $string = $_POST['email'];
                if (validation_email($string)) {
                    $data['email'] = $string;
                } else {
                    $error['email'] = 'Email is not valid';
                }
            }

            $data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
            $data['gender'] = isset($_POST['gender']) ? $_POST['gender'] : '';
            $data['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
            $data['address'] = isset($_POST['address']) ? $_POST['address'] : '';
            //select address
            $data['select_Province'] = isset($_COOKIE['name_Province']) ? $_COOKIE['name_Province'] : '';
            $data['select_Districts'] = isset($_COOKIE['name_Districts']) ? $_COOKIE['name_Districts'] : '';
            $data['select_Wards'] = isset($_COOKIE['name_Wards']) ? $_COOKIE['name_Wards'] : '';
            
            
            if (empty($data['name'])) {
                $error['name'] = 'Bạn chưa nhập tên';
            } elseif (empty($data['phone'])) {
                $error['phone'] = 'Bạn chưa nhập phone';
            } elseif (empty($data['email'])) {
                $error['email'] = 'Bạn chưa nhập email';
            } elseif (empty($data['password'])) {
                $error['password'] = 'Bạn chưa nhập password';
            } elseif (empty($data['gender'])) {
                $error['gender'] = 'Bạn chưa chọn gender';
            } elseif (empty($data['birthday'])) {
                $error['birthday'] = 'Bạn chưa chọn birthday';
            } elseif (empty($data['address'])) {
                $error['address'] = 'Bạn chưa nhập address';
            }
            elseif (empty($data['select_Province'])) {
                $error['select_Province'] = 'Bạn chưa chọn Province';
            } elseif (empty($data['select_Districts'])) {
                $error['select_Districts'] = 'Bạn chưa chọn Districts';
            } elseif (empty($data['select_Wards'])) {
                $error['select_Wards'] = 'Bạn chưa chọn Wards';
            }
            
            //--------------------------------
            if (!$error) {
                $created_at = date("Y/m/d");
                $updated_at = null;
                
                //$check = $db->InsertUser($data['name'], $data['phone'], $data['email'], $data['gender'], $data['birthday'], $data['address'], $created_at, $updated_at);

                //set data
                $url_create_user = PATH_API . "/api/users/create_user.php";

                //$dataadress = $data['address'] . ", " . $data['select_Wards'] . ", " . $data['select_Districts'] . ", " . $data['select_Province'];

                $sent_data = array(
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'gender' => $data['gender'],
                    'date_birth' => $data['birthday'],
                    'address' => $data['address'] . ", " . $data['select_Wards'] . ", " . $data['select_Districts'] . ", " . $data['select_Province'],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                );

                
                $result = callAPI('POST', $url_create_user, json_encode($sent_data));

                $result = json_decode($result, true);

                if ($result['message'] == "Phone or email already in use") {
                    $check_response_insert = 1;
                } else if ($result['message'] == "User Created") {
                    $check_response_insert = 2;
                } else {
                    $check_response_insert = 3;
                }
            }
        }

        $path = "\storage\app\data\data_address.json";
        $address_json = json_decode(read_data_json_address($path), true);

        require_once('view/user/insert_user.php');
        break;
        //---------------------------------------------------------------------------
    case 'show_user':
        
        $url_show_users = PATH_API . "/api/users/read.php";

        $data_list_user = [];
        $response_list_data = callAPI('GET', $url_show_users, false);
        $data = json_decode($response_list_data, true);
        //$data = json_decode(file_get_contents($url_show_users), true);
        // echo "Data........", var_dump($data['data']);

        if (isset($data['data'])) {
            $data_list_user = $data['data'];
        }

        //-----------Delete User
        if (isset($_POST['submit_detete_user'])) {

            $data_cookie = json_decode($_COOKIE['login_user'], true);

            if ($data_cookie['email'] != "" && $data_cookie['password'] != "") {
                if (isset($_POST['delete_users'])) {
                    foreach ($_POST['delete_users'] as $delete) {
                        $user = finduser($delete, $data['data']);
                        if ($user[0]['created_at'] == NULL) {
                            //Xoa verify chua xac thuc va xoa nguoi dung
                            $find_email_verify = $user[0]['email'];
                            $url_delete_verify = PATH_API . "/api/login/delete_verify.php?email=$find_email_verify";
                            $delete_verify = callAPI('DELETE', $url_delete_verify, false);

                            $url_delete_user = PATH_API . "/api/users/delete_user.php?id=$delete";
                            $response_detele_user = callAPI('DELETE', $url_delete_user, false);
                        } else {
                            //Xoa nguoi dung
                            $url_delete_user = PATH_API . "/api/users/delete_user.php?id=$delete";
                            $response_detele_user = callAPI('DELETE', $url_delete_user, false);
                        }
                    }
                    header('location: index.php?controller=user&action=show_user');
                } else {
                    echo "Chưa lựa chọn.";
                }
            } else {
                header('location: index.php?controller=login&action=login');
            }
        }
        //-------------Search
        if (isset($_POST['submit_search_usser'])) {
            $name = $_POST['search-usser'];
            $url_search_user_by_name = PATH_API . "/api/users/search_user.php?name=$name";
            $data_search = json_decode(file_get_contents($url_search_user_by_name), true);
            $data_list_user = $data_search['data'];
        }
        //--------------Update
        if (isset($_POST['submit_update_users'])) {
            if (!isset($_COOKIE['login_user'])) {
                header('location: index.php?controller=login&action=login');
            } else {
            }
        }
        //-----------------Logout
        if (isset($_POST['show_user_btn_logout'])) {
            // set null value cookie
            $data_cookie = array(
                "auto_login" => 0,
                "email" => "",
                "password" => ""
            );
            setcookie('login_user', json_encode($data_cookie), time() + 86400, "/");
            header('location: index.php?controller=user&action=show_user');
        }
        if (count(array($data_list_user)) == 0) {
            null;
        }
        require_once('view/user/show_user.php');
        break;
        //---------------------------------------------------------------------------
    case 'update_user':


        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $url_show_id_user = PATH_API . "/api/users/read_single.php?id=$id";
            //echo "linkkk urll... $url_show_id_user";
            $data_id_user = json_decode(file_get_contents($url_show_id_user), true);

            $data_user_Id = $data_id_user;
            if (isset($_POST['update_update_user'])) {
                $url_update_user = PATH_API . "/api/users/update_user.php";
                //Setup request to send data json POST
                $sent_data = array(
                    'id' => $id,
                    'name' => $_POST['update_name'],
                    'phone' => $_POST['update_phone'],
                    'email' => $_POST['update_email'],
                    'gender' => $_POST['update_gender'],
                    'date_birth' => $_POST['update_birthday'],
                    'address' => $_POST['update_address'],
                    'created_at' => $data_user_Id['created_at'],
                    'updated_at' => date("Y/m/d")
                );

                //callAPI
                $update_user = callAPI('PUT', $url_update_user, json_encode($sent_data));
                $response = json_decode($update_user, true);

                // echo "response data : ... ", $response[];
                //echo "response data : ... ", $response['message'];

                if ($response['message'] == "Update Success") {
                    echo "Update Success";
                    header('location: index.php?controller=user&action=show_user');
                } else {
                    echo "Update Failed";
                }
            }
        }
        require_once('view/user/update_user.php');
        break;

    case 'select_address':

        if (isset($_POST['dataProvince'])) {
            //call the function or execute the code
            $dataProvince = $_POST['dataProvince'];
            // $path = "E:\\Xamppp_Nam4\\htdocs\\basicPHP\\BEApi\\storage\\app\\data\\data_address.json";
            $path = "\storage\app\data\data_address.json";
            $data_address = json_decode(read_data_json_address($path), true);

            //Tach chuoi
            $array_string = cut_String($dataProvince, ";");
            $id_Province = $array_string[0];
            $name_Province = $array_string[1];
            // set value in cookie
            setcookie('name_Province', $name_Province, time()+(60*2), "/");
            if(isset($_COOKIE['name_Districts'])){
                setcookie('name_Districts', '', time()+(60*2), "/");
            }
            if(isset($_COOKIE['name_Wards'])){
                setcookie('name_Wards', '', time()+(60*2), "/");
            }

            //Tim kiem danh sach Quan huyen
            foreach ($data_address as $key => $value) {
                if ($value['Id'] == $id_Province) {
                    $data_Districts = $value['Districts'];
                    break;
                }
            }
            echo "<option key='0'>Tỉnh/ Thành phố</option>";
            foreach ($data_Districts as $key => $value) {
                // echo "<option key='" . $value['Id'] . "' value='" . $value['Id'] . ";" .$value['Name'] . "'>" . $value['Name'] . "</option>";
                echo "<option key='" . $value['Id'] . "' value='" . $id_Province . ";" . $value['Id'] . ";" . $value['Name'] . "'>" . $value['Name'] . "</option>";
            }
        }


        if (isset($_POST['dataDistricts'])) {
            //call the function or execute the code
            $data_Districts = $_POST['dataDistricts'];
            // $path = "E:\\Xamppp_Nam4\\htdocs\\basicPHP\\BEApi\\storage\\app\\data\\data_address.json";
            $path = "\storage\app\data\data_address.json";
            $data_address = json_decode(read_data_json_address($path), true);
            //Tach chuoi ta co dc Id quan huyen va id phuong xa
            $array_string = cut_String($data_Districts, ";");
            $id_Province = $array_string[0];
            $id_Districts = $array_string[1];
            $name_Districts = $array_string[2];
            // set value in 
            setcookie('name_Districts', $name_Districts, time()+(60*2), "/");
            if(isset($_COOKIE['name_Wards'])){
                setcookie('name_Wards', '', time()+(60*2), "/");
            }

            //Tim kiem danh sach quan huyen
            $data_Districts = array();
            foreach ($data_address as $key => $value) {
                if ($value['Id'] == $id_Province) {
                    $data_Districts = $value['Districts'];
                    break;
                }
            }

            //Tim kiem danh sach phuong xa
            $data_Wards = array();
            foreach ($data_Districts as $key => $value) {
                if ($value['Id'] == $id_Districts) {
                    $data_Wards = $value['Wards'];
                    break;
                }
            }
            echo "<option key='0'>Phường/ Xã</option>";
            foreach ($data_Wards as $key => $value) {
                // echo "<option key='" . $value['Id'] . "' value='" . $value['Id'] . ";" .$value['Name'] . "'>" . $value['Name'] . "</option>";
                echo "<option key='" . $value['Id'] . "' value='" . $value['Name'] . "'>" . $value['Name'] . "</option>";
            }
        }

        if (isset($_POST['dataWards'])) {

            $name_Wards = $_POST['dataWards'];
            // set value in $GLOBALS
            setcookie('name_Wards', $name_Wards, time()+(60*2), "/");
            
        }
}
