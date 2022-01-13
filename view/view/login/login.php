<head>
    <style>
        .form-login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            width: 600px;
            height: 500px;
            border-radius: 4px;
        }

        .form-login-container-label {
            margin: 0 0 20px;
            padding: 0;
            text-align: center;
            font-size: 40px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .form-login-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-login-btn {
            display: flex;
            justify-content: center;
        }

        .form-login-input {

            padding: 15px;
            margin: 8px 0;
            font-size: 18px;
            width: 100%;
            border: 1px solid #110d0d;
            /* box-sizing: border-box; */
            /* border: none; */
            outline: none;
        }

        .form-login-label {
            position: absolute;
            top: 11px;
            left: 15px;
            padding: 10px 0;
            font-size: 21px;
            height: 30px;
            /* border-top-left-radius: 20px;
            border-top-right-radius: 20px; */
            pointer-events: none;
            transition: 0.5s;
            background: #ffffff;
            /* background: #8d8686; */

        }

        .form-login-group .form-login-input:focus+.form-login-label,
        .form-login-group .form-login-input:valid+.form-login-label {
            top: -12px;
            left: 7px;
            font-size: 18px;

        }

        /* .form-login-check-response {
            color: #e70a0a;
        } */

        .form-login-container-btn-login {
            width: 220px;
            height: 100%;
            background-color: #110d0d;
            color: white;
            font-size: 20px;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-login-container-btn-login:hover {
            opacity: 0.7;
        }

        .form-login-row{
            display: flex;
            justify-content: center;
        }
        
        .form-login-row-col{
            padding: 5px;
        }

        .form-login-row-col:hover{
            color: red;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <div class="form-login-container">
        <form action="" method="POST">
            <h2 class="form-login-container-label">Login</h2>
            <div class="form-login-container-form">
                <div class="form-login-group">
                    <input class="form-login-input" type="text" placeholder="" name="login_email" value="<?php echo isset($_POST['login_email']) ? $_POST['login_email'] : $data_cookie_email ?>" required>
                    <!-- style="<?php echo isset($error['email']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" -->
                    <label class="form-login-label" for="email"><b>Email</b></label>
                </div>
                <!-- required: hien thi thong bao neu de trong truong nay -->
                <div class="form-login-group">
                    <input class="form-login-input" type="password" placeholder="" name="login_password" value="<?php echo isset($_POST['login_password']) ? $_POST['login_password'] : $data_cookie_password ?>" required>
                    <!-- style="<?php echo isset($error['password']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" -->
                    <label class="form-login-label" for="psw"><b>Password</b></label>
                </div>

                <div class="form-login-check-response">
                    <?php
                    if ($check == 1) {
                        echo "Email not verified <a href='index.php?controller=login&action=email_verify&email=" . $data['email'] . "'><p style='color: #e70a0a;'>Click here</p></a>";
                        // header('location: index.php?controller=user&action=show_user');
                    } elseif ($check == 2) {
                        echo "<p style='color: #e70a0a;'>Invalid password </p>";
                    } elseif ($check == 3) {
                        echo "<p style='color: #e70a0a;'>Invalid email and password </p>";
                    } elseif ($check == 4) {
                        echo "<p style='color: #10991a;'>Login thanh cong</p>";
                        header('location: index.php?controller=user&action=show_user');
                    } else {
                        null;
                    }
                    ?>
                </div>
                <label>
                    <input type="checkbox" name="form_login_remember" value="1"> Remember me
                </label>
                <div class="form-login-btn">
                    <button class="form-login-container-btn-login" type="submit" name="login_submit">Login</button>
                    
                </div>
            </div>

            <div class="form-login-row">
                <!-- <button type="button" class="cancelbtn">Cancel</button> -->
                <a class="form-login-row-col" href="index.php?controller=login&action=forgot_password">Forgot password</a>
                <a class="form-login-row-col" href="index.php?controller=user&action=show_user">Show User</a>
            </div>
        </form>
    </div>
</body>