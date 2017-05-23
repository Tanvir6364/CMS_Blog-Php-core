<?php
include '../lib/Session.php';
Session::checkSession();
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';

$db = new Database();
?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == null){
    echo "<script>window.location='index.php';</script>";
}else {
    $id = $_GET['pageid'];



    $delquery="delete from tbl_page where id='$id'";
    $deldata=$db->delete($delquery);
    if($deldata){
        echo "<script>alert('Data deleted Successfully')</script>";
        echo "<script>window.location='index.php';</script>";
    }else{
        echo "<script>alert('Data not deleted')</script>";
        echo "<script>window.location='index.php';</script>";
    }
}

?>
