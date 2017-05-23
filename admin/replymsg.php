<?php include 'inc/header.php';
if(!isset($_GET['msgid']) || $_GET['msgid']==null){
    echo "<script>window.location='inbox.php';</script>";
}else{
    $id=$_GET['msgid'];
}
?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Post</h2>
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST') {
                $to = $fm->validation($_POST['toEmail']);
                $from = $fm->validation($_POST['fromEmail']);
                $subject = $fm->validation($_POST['subject']);
                $message = $fm->validation($_POST['message']);

                $sendmail=mail($to,$subject,$message,$from);
                if($sendmail){
                    echo "<span style='color: green;font-size: 18px;'>Message Sent Successfully</span>";
                }else{
                    echo "<span style='color: red;font-size: 18px;'>Something Wrong</span>";
                }
            }
            ?>
            <div class="block">
                <?php
                $query = "select * from tbl_contact where id='$id' order by id DESC";
                $found=$db->select($query);
                if($found){
                    while ($result=$found->fetch_assoc()){
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <table class="form">
                                <tr>
                                    <td>
                                        <label>To</label>
                                    </td>
                                    <td>
                                        <input type="text" name="toEmail" readonly value="<?php echo $result['email'];?>" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>From</label>
                                    </td>
                                    <td>
                                        <input type="text" name="fromEmail" placeholder="Enter your email" class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Subject</label>
                                    </td>
                                    <td>
                                        <input type="text" name="subject" placeholder="Enter your subject" class="medium" />
                                    </td>
                                </tr>

                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Message</label>
                                    </td>
                                    <td>
                                        <textarea class="tinymce" name="message"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Send" />
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