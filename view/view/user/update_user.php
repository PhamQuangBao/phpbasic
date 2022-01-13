<div class="add-user-container">
    <h2 class="add-user-title">Update user</h2>
    <form action="" method="POST">
        <table>
            <tr>
                <td class="add-user-label">
                    Full Name:
                </td>
                <td class="add-user-input">
                    <input type="text" placeholder="Full name *" value="<?php echo $data_user_Id['name'];?>" name="update_name">
                </td>
            </tr>
            <tr>
                <td class="add-user-label">
                    Phone:
                </td>
                <td class="add-user-input">
                    <input type="text" placeholder="Phone *" value="<?php echo $data_user_Id['phone'];?>" name="update_phone">
                </td>
            </tr>
            <tr>
                <td class="add-user-label">
                    Email:
                </td>
                <td class="add-user-input">
                    <input type="mail" placeholder="Email *" value="<?php echo $data_user_Id['email'];?>" name="update_email">
                </td>
            </tr>
            <tr>
                <td class="add-user-label">
                    Gender:
                </td>
                <td>
                    <input type="radio" id="1" name="update_gender" value="1" <?php echo ($data_user_Id['gender']==1)?'checked':'' ?> >
                    <label for="html">Nam</label><br>
                    <input type="radio" id="0" name="update_gender" value="0" <?php echo ($data_user_Id['gender']==0)?'checked':'' ?> >
                    <label for="html">Nữ</label><br>
                </td>
            </tr>
            <tr>
                <td class="add-user-label">
                    Birthday:
                </td>
                <td>
                    <input type="date" id="birthday" value="<?php echo $data_user_Id['date_birth'];?>" name="update_birthday">
                </td>
            </tr>
            <tr>
                <td class="add-user-label">
                    Address:
                </td>
                <td class="add-user-input">
                    <input type="text" placeholder="Address *" value="<?php echo $data_user_Id['address'];?>" name="update_address">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="btn-submit" name="update_update_user" value="UPDATE">
                </td>
                <td>
                    <a href="index.php?controller=user&action=show_user">Show User</a>
                </td>
            </tr>
        </table>
    </form>
   
</div>