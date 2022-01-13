<head>
    <style>
        .forgot-passwork-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            width: 350px;
            background: rgb(222 222 222);
            border-radius: 4px;
        }

        .forgot-passwork-row{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-content: center;
            justify-content: center;
            
        }

        .forgot-passwork-row-label{
            font-weight: 800;
            margin-bottom: 20px;
        }

        .forgot-passwork-input {
            width: 280px;
            height: 30px;
            padding-left: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .forgot-passwork-submit {
            width: 100%;
            height: 35px;
            border: 1px solid #333;
            outline: none;
            font-size: 18px;
            background: rgb(39, 37, 37);
            color: aliceblue;
            text-shadow: rgb(255, 255, 255);
            border-radius: 2px;
            cursor: pointer;
        }

        .forgot-passwork-submit:hover {
            background: aliceblue;
            color: rgb(39, 37, 37);
            text-shadow: rgb(255, 255, 255);
            cursor: pointer;
        }

        .email-verify-code {
            width: 100%;
            height: 30px;
            margin-left: 2px;
            margin-right: 2px;
            border: 1px solid #333;
            outline: none;
            background: rgb(39, 37, 37);
            color: aliceblue;
            text-shadow: rgb(255, 255, 255);
            border-radius: 2px;
            cursor: pointer;
        }

        .email-verify-code:hover {
            background: aliceblue;
            color: rgb(39, 37, 37);
            text-shadow: rgb(255, 255, 255);
            cursor: pointer;
        }

        .email-verify-check-vali {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="forgot-passwork-container">
        <div class="forgot-passwork-row">
            <h2 class="forgot-passwork-row-label">Forgot Password</h2>
            <form method="POST">
                <input class="forgot-passwork-input" type="text" name="forgot_passwork_inp_email" placeholder="Email*" value="<?php echo isset($_POST['forgot_passwork_inp_email']) ? $_POST['forgot_passwork_inp_email'] : '' ?>" 
                style="<?php echo isset($error['fpw_email']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>"/>
                
                <input class="forgot-passwork-input" type="password" name="forgot_passwork_inp_pas" placeholder="Password*" value="<?php echo isset($_POST['forgot_passwork_inp_pas']) ? $_POST['forgot_passwork_inp_pas'] : '' ?>" 
                style="<?php echo isset($error['fpw_password']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>"/>
                
                <input class="forgot-passwork-input" type="password" name="forgot_passwork_inp_conf_pas" placeholder="Confirm password*" value="<?php echo isset($_POST['forgot_passwork_inp_conf_pas']) ? $_POST['forgot_passwork_inp_conf_pas'] : '' ?>" 
                style="<?php echo isset($error['fgw_conf_pass']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>"/>
                
                <input class="forgot-passwork-submit" type="submit" name="forgot_passwork_btnsubmit" />

                <div class="forgot-passwork-response">
                    <?php
                    if ($check == 1) {
                        echo "<p style='color: #10991a;'>Change Password Success</p>";
                        
                        header('location: index.php?controller=login&action=email_verify&email=' . $data['fpw_email']);
                    } elseif ($check == 2) {
                        echo "<p style='color: #e70a0a;'>Change Password Failuer</p>";
                    } elseif ($check == 3) {
                        echo "<p style='color: #e70a0a;'>Password does not match</p>";
                    }else {
                        null;
                    }
                    ?>
                </div>
            
            </form>
        </div>
    </div>
</body>