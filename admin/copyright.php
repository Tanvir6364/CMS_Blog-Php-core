<?php include 'inc/header.php'?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $note = mysqli_real_escape_string($db->link, $fm->validation($_POST['note']));


                    if ($note == "") {
                        echo "<span style='color: red;font-size: 18px;'>File Must Not Be Empty!!!</span>";
                    } else {
                        $query = "update tbl_footer set
                        note='$note' where id='1'";

                        $updated = $db->insert($query);
                        if ($updated) {
                            echo "<span style='color: green;font-size: 18px;'>Data Successfully Inserted</span>";
                        } else {
                            echo "<span style='color: red;font-size: 18px;'>Data Not Inserted</span>";
                        }
                    }
                }

                ?>


                <div class="block copyblock">
                    <?php
                    $query = "select * from tbl_footer where id='1'";
                    $found = $db->select($query);
                    if ($found) {
                    while ($result = $found->fetch_assoc()) {
                    ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note'];?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'?>

