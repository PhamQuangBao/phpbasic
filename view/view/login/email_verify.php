<head>
    <style>

        .email-verify-container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            /* width: 100%;
            height: 100%; */
            background: rgb(222 222 222);
            border-radius: 4px;
        }

        .email-verify-label{
            margin-bottom: 10px;
        }


        .email-verify-input{
            width: 280px;
            height: 30px;
            padding-left: 5px;
            font-size: 16px;
        }

        .email-verify-submit{
            width: 80px;
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
        
        .email-verify-submit:hover{
            background: aliceblue;
            color: rgb(39, 37, 37);
            text-shadow: rgb(255, 255, 255);
            cursor: pointer;
        }

        .email-verify-code{
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

        .email-verify-code:hover{
            background: aliceblue;
            color: rgb(39, 37, 37);
            text-shadow: rgb(255, 255, 255);
            cursor: pointer;
        }

        .email-verify-check-vali{
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="email-verify-container">
        <h2 class="email-verify-label">Verify</h2>
        <form method="POST">
            <input class="email-verify-input" type="text" name="email_verify_code" placeholder="Enter verification code from email" value="<?php echo isset($_POST['email_verify_code']) ? $_POST['email_verify_code']: '' ?>"/>
            <input class="email-verify-submit" type="submit" name="email_verify_btnsubmit" />
            <div>
                <?php
                    if($check == 1){
                        echo "<p class='email-verify-check-vali' style='color: #e70a0a;'>Code confirmation time late</p>";
                        echo "<button class='email-verify-code' name='email_verify_btn_send_back'>Send back email ". $_GET['email'] ."</button>";
                    }
                    elseif($check == 2){
                        echo "<p class='email-verify-check-vali' style='color: #e70a0a;'>Verification Failed</p>";
                    }
                    elseif($check == 3){
                        echo "<p class='email-verify-check-vali' style='color: #10991a;'>Update your verification code</p>";
                    }
                    else {
                        null;
                    }
                ?>
            </div>
        </form>
    </div>
</body>

