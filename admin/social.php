<?php include 'inc/header.php'?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $fb = mysqli_real_escape_string($db->link, $fm->validation($_POST['facebook']));
                    $tw = mysqli_real_escape_string($db->link, $fm->validation($_POST['twitter']));
                    $ln = mysqli_real_escape_string($db->link, $fm->validation($_POST['linkedin']));
                    $gp = mysqli_real_escape_string($db->link, $fm->validation($_POST['google_plus']));

                    if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
                        echo "<span style='color: red;font-size: 18px;'>File Must Not Be Empty!!!</span>";
                    } else {
                        $query = "update tbl_social set
                        facebook='$fb',twitter='$tw',linkedin='$ln',google_plus='$gp' where id='1'";

                        $updated = $db->insert($query);
                        if ($updated) {
                            echo "<span style='color: green;font-size: 18px;'>Data Successfully Inserted</span>";
                        } else {
                            echo "<span style='color: red;font-size: 18px;'>Data Not Inserted</span>";
                        }
                    }
                }

?>
                <div class="block">
                    <?php
                    $query = "select * from tbl_social where id='1'";
                    $getsocial = $db->select($query);
                    if($getsocial){
                    while ($result = $getsocial->fetch_assoc()) {

                    ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['facebook'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result['twitter'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $result['linkedin'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="google_plus" value="<?php echo $result['google_plus'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }}?>
                </div>
            </div>
        </div>

        <?php include 'inc/footer.php'?>
