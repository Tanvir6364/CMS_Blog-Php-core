<?php include 'inc/header.php'?>
<?php if(!Session::get('userRole')=='0') {
    echo "<script>window.location='index.php';</script>";
}?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST') {
                $username = mysqli_real_escape_string($db->link, $fm->validation($_POST['username']));
                $password = mysqli_real_escape_string($db->link, $fm->validation(md5($_POST['password'])));
                $email = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
                $role = mysqli_real_escape_string($db->link, $fm->validation($_POST['role']));

                if (empty($username) || empty($password) || empty($email) || empty($role)) {
                    echo "<span style='color: red;font-size: 18px;'>Field Must Not be EMPTY</span>";
                } else {

                    $query = "select * from tbl_user where email='$email' limit 1";
                    $checkEmail = $db->select($query);
                    if ($checkEmail != false) {
                        echo "<span style='color: red;font-size: 18px;'>This Email Already Exists</span>";
                    } else {
                        $query = "insert into tbl_user(username,password,email,role) values('$username','$password','$email','$role')";
                        $insert = $db->insert($query);
                        if ($insert) {
                            echo "<span style='color: green;font-size: 18px;'>User Created Successfully</span>";
                        } else {
                            echo "<span style='color: red;font-size: 18px;'>User Not Created</span>";
                        }
                    }
                }
            }

            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>User Name</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>User Roll</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'?>
