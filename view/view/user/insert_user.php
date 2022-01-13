<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <h1> Add User</h1> -->
    <style>
        .add-user-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            min-width: 600px;
            height: 630px;
            border-radius: 4px;
        }

        .add-user-orderForm-title {
            margin-bottom: 10px;
            color: rgb(12, 11, 11);
            text-align: center;
        }

        .add-user {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;

            align-content: center;
            justify-content: center;
            background: #f6f6f6;
            padding: 25px;
        }

        .add-user-row-col-btn {
            display: flex;
            justify-content: center;
        }

        .btn-submit {
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

        .btn-submit:hover {
            background: aliceblue;
            color: rgb(39, 37, 37);
            text-shadow: rgb(255, 255, 255);
            cursor: pointer;
        }

        .payment .orderForm {
            margin: 35px 20px 20px 20px;
        }

        .payment .orderForm h2 {
            margin-bottom: 10px;
            padding-left: 20px;
            font-size: 30px;
        }

        .payment .orderForm .row-radio-tt {
            padding: 15px 0;
        }

        .orderForm-group-radio {
            padding: 5px;
            margin-bottom: 10px;
        }

        .form-control {
            /* input[type = "text"] */
            width: 490px;
            height: 35px;
            padding: 5px 10px;
            margin-bottom: 20px;
            border: 1px solid #979292;
            color: #888;
        }

        .address-container-chil {
            display: flex;

            align-content: center;
            justify-content: center;
        }

        .form-control-chil-1 {
            width: 46%;
            height: 35px;
            padding: 5px 10px;
            margin-bottom: 20px;
            border: 1px solid #979292;
            color: #888;
        }

        .form-control-chil-2 {
            width: 46%;
            height: 35px;
            padding: 5px 10px;
            margin-left: 55px;
            margin-bottom: 20px;
            border: 1px solid #979292;
            color: #888;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


</head>

<script type="text/javascript">
    $(document).ready(function() {
        $('#select_Province').change(function() {
            var dataProvince = $(this).val();

            //Ajax for calling php function
            $.post('index.php?controller=user&action=select_address', {
                dataProvince: dataProvince
            }, function(data) {
                $('#select_Districts').html(data);
            });
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#select_Districts').change(function() {
            var dataDistricts = $(this).val();

            //Ajax for calling php function
            $.post('index.php?controller=user&action=select_address', {
                dataDistricts: dataDistricts
            }, function(data) {
                $('#select_Wards').html(data);
            });
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#select_Wards').change(function() {
            var dataWards = $(this).val();

            //Ajax for calling php function
            $.post('index.php?controller=user&action=select_address', {
                dataWards: dataWards
            });
        })
    })
</script>

<body>

    <div class="add-user-container">
        <!-- <h2 class="add-user-title">Add detail user</h2> -->
        <div class="add-user">
            <form class="orderForm" method="POST">
                <h2 class="add-user-orderForm-title">Add detail user</h2>
                <div class="">
                    <input id="id-name-payment" type="text" class="form-control" placeholder="HỌ TÊN *" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" style="<?php echo isset($error['name']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" />
                    <input id="id-phone-payment" type="text" class="form-control" placeholder="Số điện thoại *" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" style="<?php echo isset($error['phone']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" />
                    <input id="id-email-payment" type="text" class="form-control" placeholder="Email *" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" style="<?php echo isset($error['email']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" />
                    <input id="id-password-payment" type="password" class="form-control" placeholder="Password *" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" style="<?php echo isset($error['password']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" />

                    <div class="orderForm-group-radio">
                        <input type="radio" id="1" name="gender" checked value="1" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 1) ? 'checked' : '' ?>>
                        <label for="html">Nam</label><br>
                        <input type="radio" id="0" name="gender" value="0" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 0) ? 'checked' : '' ?>>
                        <label for="html">Nữ</label><br>
                        <input type="date" id="birthday" name="birthday" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : '' ?>" style="<?php echo isset($error['birthday']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>">
                    </div>

                    <input id="id-address-payment" type="text" class="form-control" placeholder="Địa chỉ *" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" style="<?php echo isset($error['address']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>" />

                    <div class="address-container">
                        <select class="form-control Province" id="select_Province" style="<?php echo isset($error['select_Province']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>">
                            <option key="0">Tỉnh/ Thành phố</option>
                            <?php
                            foreach ($address_json as $key => $value) {
                                // echo "<option key='" . $value['Id'] . "' value='" . $value['Id'] . ";" .$value['Name'] . "'>" . $value['Name'] . "</option>";
                                echo "<option key='" . $value['Id'] . "' value='" . $value['Id'] . ";" . $value['Name'] . "'>" . $value['Name'] . "</option>";
                            }

                            ?>
                        </select>

                        <div class="address-container-chil">
                            <select class="form-control-chil-1 Districts" id="select_Districts" style="<?php echo isset($error['select_Districts']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>">
                                <option key="0">Quận/ Huyện</option>

                            </select>
                            <select class="form-control-chil-2 Wards" id="select_Wards" style="<?php echo isset($error['select_Wards']) ? "border: 2px solid rgb(224, 16, 16);" : "border: 1px solid rgb(20, 20, 20);" ?>">
                                <option key="0">Phường/ Xã</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="add-user-row-col-btn">
                    <input type="submit" class="btn-submit" name="add_user" value="INSERT">
                    <a href="index.php?controller=user&action=show_user">Show User</a>
                </div>
                <div>
                    <?php
                    if ($check_response_insert == 1) {
                        echo "<p style='color: #e70a0a;'>Phone or email already in use</p>";
                    } else if ($check_response_insert == 2) {
                        echo "<p style='color: #10991a;'>Created User Success</p>";
                    } else if ($check_response_insert == 3) {
                        echo "<p style='color: #e70a0a;'>Created User Failed</p>";
                    } else {
                        null;
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>


</body>

</html>