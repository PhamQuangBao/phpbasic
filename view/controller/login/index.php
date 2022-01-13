<?php

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

require_once ROOT_PATH . '\utils\utils.php';


switch ($action) {
        //---------------------------------------------------------------------------

    case 'login':
        $error = array();
        $data = array();
        $check = 0;
        $data_cookie_email = "";
        $data_cookie_password = "";
        if (isset($_POST['login_submit'])) {
            $data['email'] = isset($_POST['login_email']) ? $_POST['login_email'] : '';
            $data['password'] = isset($_POST['login_password']) ? $_POST['login_password'] : '';

            if (empty($data['email'])) {
                $error['email'] = 'Bạn chưa nhập email';
            } elseif (empty($data['password'])) {
                $error['password'] = 'Bạn chưa nhập password';
            } else {
            }

            if (!$error) {

                $url_login = PATH_API . "/api/login/login.php";

                $sent_data = array(
                    'email' => $data['email'],
                    'password' => $data['password'],
                );

                //callAPI
                $login_user = callAPI('POST', $url_login, json_encode($sent_data));
                $response = json_decode($login_user, true);

                // ---------------------Set cookie
                if (isset($response['data'])) {
                    $data_cookie = array(
                        "auto_login" => 0,
                        "email" => $data['email'],
                        "password" => $data['password']
                    );
                    // setcookie('email', $data['email'], time() + 86400, "/");
                    // setcookie('password', $data['password'], time() + 86400, "/");
                    //1 Day = 86400
                    setcookie('login_user', json_encode($data_cookie), time() + 86400, "/");
                } else {
                }
                // --------------------resonse data
                if ($response['message']) {
                    if ($response['message'] == "Email not verified") {
                        $check = 1;
                    } elseif ($response['message'] == "Invalid password") {

                        $check = 2;
                    } elseif ($response['message'] == "Invalid email and password") {

                        $check = 3;
                    }
                }
                //-------------------remeber user-----
                if (isset($_POST['form_login_remember'])) {
                    if (isset($response['data'])) {
                        $data_cookie = array(
                            "auto_login" => 1,
                            "email" => $data['email'],
                            "password" => $data['password']
                        );
                        // setcookie('email', $data['email'], time() + 86400, "/");
                        // setcookie('password', $data['password'], time() + 86400, "/");
                        //1 Day = 86400
                        setcookie('login_user', json_encode($data_cookie), time() + 86400, "/");
                    }
                }
                //-------------check remember

                if (isset($response['data'])) {
                    $check = 4;
                }
            }
        }
        if (isset($_COOKIE['login_user'])) {
            $data_cookie = json_decode($_COOKIE['login_user'], true);
            if ($data_cookie['auto_login'] == 1) {
                $data_cookie_email = $data_cookie['email'];
                $data_cookie_password = $data_cookie['password'];
            }
        }

        require_once('view/login/login.php');
        break;
    case 'email_verify':
        $error = array();
        $data = array();
        $check = 0;
        if (isset($_GET['email'])) {
            $data['email'] = $_GET['email'];

            $data['code'] = isset($_POST['email_verify_code']) ? $_POST['email_verify_code'] : '';

            if (empty($data['code'])) {
                $error['code'] = 'Bạn chưa nhập ma code';
            } else {
            }

            if (isset($_POST['email_verify_btnsubmit'])) {
                if (!$error) {
                    $url_verify1 = PATH_API . "/api/login/verify.php";

                    $sent_data = array(
                        'email' => $data['email'],
                        'code' => $data['code'],
                    );

                    $update_verify1 = callAPI('POST', $url_verify1, json_encode($sent_data));
                    $response = json_decode($update_verify1, true);

                    if ($response['message'] == "Update verify user Success") {

                        header('location: index.php?controller=login&action=login');
                    } else if ($response['message'] == "Code confirmation time late") {
                        //echo "QUa thoi gian nhap ma xac nhan Click vao de gui lai";
                        $check = 1;
                    } else {
                        //echo "Update Failed";
                        $check = 2;
                    }
                }
            }
            //Send code gmail - update verify
            if (isset($_POST['email_verify_btn_send_back'])) {
                $url_update_verify1 = PATH_API . "/api/login/update_verify.php";
                $sent_data = array(
                    'email' => $data['email']
                );
                $update_verify1 = callAPI('PUT', $url_update_verify1, json_encode($sent_data));
                $response = json_decode($update_verify1, true);

                if ($response['message'] == "Update verify Success") {

                    $check = 3;
                } else {
                    //echo "Update Failed";
                    $check = 2;
                }
            }
        }

        require_once('view/login/email_verify.php');
        break;

    case 'forgot_password':
        $error = array();
        $data = array();
        $check = 0;

        if (isset($_POST['forgot_passwork_btnsubmit'])) {

            $data['fpw_email'] = isset($_POST['forgot_passwork_inp_email']) ? $_POST['forgot_passwork_inp_email'] : '';
            $data['fpw_password'] = isset($_POST['forgot_passwork_inp_pas']) ? $_POST['forgot_passwork_inp_pas'] : '';
            $data['fgw_conf_pass'] = isset($_POST['forgot_passwork_inp_conf_pas']) ? $_POST['forgot_passwork_inp_conf_pas'] : '';

            if (empty($data['fpw_email'])) {
                $error['fpw_email'] = 'Bạn chưa nhập Email';
            } elseif (empty($data['fpw_password'])) {
                $error['fpw_password'] = 'Bạn chưa nhập Password';
            } elseif (empty($data['fgw_conf_pass'])) {
                $error['fgw_conf_pass'] = 'Bạn chưa nhập lai Password';
            }

            if ($data['fpw_password'] != $data['fgw_conf_pass']) {
                $error['2_password'] = 'password khong khop';
            }

            if (!$error) {
                $url_forgot_password = PATH_API . "/api/users/forgot_password.php";

                $sent_data = array(
                    'password' => $data['fgw_conf_pass'],
                    'email' => $data['fpw_email'],
                );

                $update_pass = callAPI('POST', $url_forgot_password, json_encode($sent_data));
                $response = json_decode($update_pass, true);

                if ($response['message'] == "Update Success") {

                    $url_create_verify = PATH_API . "/api/login/create_verify.php";
                    $sent_data = array(
                        'email' => $data['fpw_email'],
                    );

                    $create_verify = callAPI('POST', $url_create_verify, json_encode($sent_data));
                    $check = 1;

                } else {
                    $check = 2;
                }

            }
            if(isset($error['2_password'])){
                $check = 3;
            }
        }

        require_once('view/login/forgot_password.php');
        break;

}
