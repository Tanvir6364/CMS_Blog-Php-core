<?php include 'inc/header.php'?>
<style>
    .left{float: left; width: 70%}
    .right{float: left; width: 20%}
    .right img{height: 160px;width: 170px;}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title = mysqli_real_escape_string($db->link,$fm->validation($_POST['title']));
                    $details = mysqli_real_escape_string($db->link, $fm->validation($_POST['details']));

                    //File Upload///
                    $permited = array('jpg', 'jpeg', 'png');
                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_temp = $_FILES['logo']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $same_image = 'logo' . '.' . $file_ext;
                    $upload_image = 'upload/' . $same_image;
                    if ($title == "" || $details == "") {
                        echo "<span style='color: red;font-size: 18px;'>File Must Not Be Empty!!!</span>";
                    }else {
                        if (!empty($file_name)) {
                            if ($file_size > 2097134) {
                                echo "<span style='color: red;font-size: 18px;'>File Size Should Be Less Then 2MB....</span>";
                            } elseif (in_array($file_ext, $permited) == false) {
                                echo "<span style='color: red;font-size: 18px;'>You Can Upload Only:- " . implode(',', $permited) . "</span>";
                            }else {
                                move_uploaded_file($file_temp, $upload_image);
                                $query="update tbl_logo set title='$title',details='$details',logo='$upload_image' where id='1'";

                                $updated = $db->insert($query);
                                if ($updated) {
                                    echo "<span style='color: green;font-size: 18px;'>Data Successfully Inserted</span>";
                                } else {
                                    echo "<span style='color: red;font-size: 18px;'>Data Not Inserted</span>";
                                }
                            }
                        }else{
                            $query="update tbl_logo set
                        title='$title',details='$details' where id='1'";

                            $updated = $db->insert($query);
                            if ($updated) {
                                echo "<span style='color: green;font-size: 18px;'>Data Successfully Inserted</span>";
                            } else {
                                echo "<span style='color: red;font-size: 18px;'>Data Not Inserted</span>";
                            }
                        }
                    }


                }
                ?>


                <?php
                $query = "select * from tbl_logo where id='1'";
                $found = $db->select($query);
                if ($found) {
                while ($result = $found->fetch_assoc()) {
                ?>
                <div class="block sloginblock">
                    <div class="left">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>" name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['details'];?>" name="details" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo"/>
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div>
                    <div class="right">
                        <img src="<?php echo $result['logo'];?>" alt="">
                    </div>
                </div>
            </div>
            <?php }}?>
        </div>
<?php include 'inc/footer.php'?>
