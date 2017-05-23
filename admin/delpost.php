<?php
include '../lib/Session.php';
Session::checkSession();
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';

$db = new Database();
?>

<?php
if (!isset($_GET['id']) || $_GET['id'] == null){
    echo "<script>window.location='postlist.php';</script>";
}else {
    $id = $_GET['id'];

    $query = "select * from tbl_post where id='$id'";
    $found = $db->select($query);
    if ($found) {
        while ($result = $found->fetch_assoc()) {
            $delink = $result['image'];
            unlink($delink);
        }
    }

    $delquery="delete from tbl_post where id='$id'";
    $deldata=$db->delete($delquery);
    if($deldata){
        echo "<script>alert('Data deleted Successfully')</script>";
        echo "<script>window.location='postlist.php';</script>";
    }else{
        echo "<script>alert('Data not deleted')</script>";
        echo "<script>window.location='postlist.php';</script>";
    }
}

?>
