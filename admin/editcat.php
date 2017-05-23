<?php include 'inc/header.php';
if(!isset($_GET['catid']) || $_GET['catid']==null){
    echo "<script>window.location='catlist.php';</script>";
}else{
    $id=$_GET['catid'];
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <?php
            if($_SERVER['REQUEST_METHOD']=='POST') {
                $name=$_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if(empty($name)){
                    echo "<span style='color: red;font-size: 18px;'>Field Must Not be EMPTY</span>";
                }else{
                    $query="update tbl_category set name='$name' where id='$id'";
                    $catupdate=$db->insert($query);
                    if ($catupdate){
                        echo "<span style='color: green;font-size: 18px;'>Data Successfully Updated</span>";
                    }else{
                        echo "<span style='color: red;font-size: 18px;'>Data Not Updated</span>";
                    }
                }
            }
            ?>
            <?php
            $query="select * from tbl_category where id='$id' order by id DESC ";
            $category=$db->select($query);
            while ($result=$category->fetch_assoc()){

            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'];?>" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php }?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'?>
