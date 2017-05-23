<?php include 'inc/header.php' ?>
<?php
$userid=Session::get('userid');
$userrole=Session::get('userRole');
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Profile</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $fm->validation($_POST['name']));
                $username = mysqli_real_escape_string($db->link, $fm->validation($_POST['username']));
                $email = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
                $details = mysqli_real_escape_string($db->link, $fm->validation($_POST['details']));

                if (empty($name) || empty($username) || empty($email) || empty($details)) {
                    echo "<span style='color: red;font-size: 18px;'>Field Must Not Be Empty</span>";
                } else {
                    $query = "update tbl_user set
                       name='$name',username='$username',email='$email',details='$details' where id='$userid'";

                    $updated = $db->insert($query);
                    if ($updated) {
                        echo "<span style='color: green;font-size: 18px;'>Data Successfully Updated</span>";
                    } else {
                        echo "<span style='color: red;font-size: 18px;'>Data Not Updated</span>";
                    }
                }
            }
            ?>
            <div class="block">
                <?php
                $query = "select * from tbl_user where id='$userid' and role='$userrole' ";
                $getuser = $db->select($query);
                if($getuser){
                while ($result = $getuser->fetch_assoc()) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>"
                                           class="medium"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $result['username']; ?>"
                                            class="medium"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $result['email']; ?>"
                                            class="medium"/>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details"><?php echo $result['details']; ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } }?>
            </div>
        </div>
    </div>

    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

<?php include 'inc/footer.php' ?>