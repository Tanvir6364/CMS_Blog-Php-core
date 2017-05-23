<?php include 'inc/header.php'?>
<style>
    .actiondel{margin-left: 10px}
    .actiondel a{background: #f0f0f0 none repeat scroll 0 0;color: #444;border: 1px solid #ddd;}

</style>

    <div class="grid_10">
        <div class="box round first grid">
            <h2>Update Post</h2>
            <?php
            if(!isset($_GET['pageid']) || $_GET['pageid']==null){
                echo "<script>window.location='index.php';</script>";
            }else{
                $id=$_GET['pageid'];
            }




            if($_SERVER['REQUEST_METHOD']=='POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);

                if($name=="" || $body=="" ){
                    echo "<span style='color: red;font-size: 18px;'>File Must Not Be Empty!!!</span>";
                }
                else{
                    $query="update tbl_page set name='$name',body='$body' where id='$id'";
                    $update=$db->insert($query);
                    if($update){
                        echo "<span style='color: green;font-size: 18px;'>Page Updated Successfully</span>";
                    }else{
                        echo "<span style='color: red;font-size: 18px;'>Page Not Update</span>";
                    }
                }


            }
            ?>
            <div class="block">
                <?php
                $query = "select * from tbl_page where id='$id'";
                $found = $db->select($query);
                if ($found) {
                while ($result = $found->fetch_assoc()) {
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text"  name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body'];?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            <span class="actiondel"><a onclick="return confirm('Are you sure to DELETE');" href="delpage.php?pageid=<?php echo $result['id'];?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                </form>

                <?php }}?>
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

<?php include 'inc/footer.php'?>