<?php

?>

<head>
    <style>

        .show-user-container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 30px;
            width: 100%;
            height: 100%;
            border-radius: 4px;
        }


    </style>
</head>

<body>
    <div class="show-user-container">
        <div class="list-user-search">
            <form action="" method="POST">
                <input type="text" class="list-user-search-input" name="search-usser" placeholder="Search by name..." onchange="search(this.value)" />
                <input type="submit" class="btn-submit" name="submit_search_usser" value="SEARCH" />
            </form>

        </div>

        <div class="list-user">
            <form action="" method="POST">
                <table border="1px">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Birth day</th>
                            <th>Address</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 1;
                        if (is_array($data_list_user) || is_object($data_list_user)) {
                            foreach ($data_list_user as $value) {
                        ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo $value['phone']; ?></td>
                                    <td><?php echo $value['email']; ?></td>
                                    <td>
                                        <?php
                                        if ($value['gender'] == 1) {
                                            echo "Nam";
                                        } else {
                                            echo "Nữ"; //
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value['date_birth']; ?></td>
                                    <td><?php echo $value['address']; ?></td>
                                    <td><?php echo $value['created_at']; ?></td>
                                    <td><?php echo $value['updated_at']; ?></td>
                                    <td>
                                        <?php

                                        if (!isset($_COOKIE['login_user'])) {
                                            echo "<a href='index.php?controller=login&action=login' name='update_user'>EDIT</a>";
                                        } else {
                                            $data_cookie = json_decode($_COOKIE['login_user'], true);

                                            if ($data_cookie['email'] != "" && $data_cookie['password'] != "") {
                                                echo "<a href='index.php?controller=user&action=update_user&id=" . $value['id'] . "' name='update_user'>EDIT</a>";
                                            } else {
                                                echo "<a href='index.php?controller=login&action=login' name='update_user'>EDIT</a>";
                                            }
                                        }

                                        ?>

                                        <label><input type="checkbox" name="delete_users[]" value="<?php echo $value['id']; ?>" />Delete</label>
                                    </td>
                                </tr>
                        <?php
                                $index++;
                            }
                        } else {
                            echo "User not found";
                        }
                        ?>

                    </tbody>
                    <tr>
                        <th></th>
                        <th><a href="index.php?controller=user&action=insert">New user</a></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <input type="submit" class="btn-submit" name="submit_detete_user" value="DELETE">
                        </th>
                    </tr>

                </table>
                <div>
                    <?php
                    if (isset($_COOKIE['login_user'])) {
                        if ($data_cookie['email'] != "" && $data_cookie['password'] != "") {
                            echo "<button class='show-user-btn-logout' name='show_user_btn_logout'>Logout</button>";
                        } else {
                            null;
                        }
                    }
                    ?>

                </div>
            </form>

        </div>
    </div>
</body>