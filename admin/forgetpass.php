<?php
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';
include '../lib/Session.php';
$db = new Database();
$fm = new Format();

Session::init();
?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
    <section id="content">
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name=$fm->validation($_POST['username']);
            $pass=$fm->validation(md5($_POST['password']));

            $name=mysqli_real_escape_string($db->link,$name);
            $pass=mysqli_real_escape_string($db->link,$pass);

            $query="select * from tbl_user where username='$name' and password='$pass'";
            $result=$db->select($query);
            if($result != false){
                $value=mysqli_fetch_array($result);
                $rows=mysqli_num_rows($result);
                if($rows>0){
                    Session::set("login",true);
                    Session::set("username",$value['username']);
                    Session::set("name",$value['name']);
                    Session::set("userid",$value['id']);
                    Session::set("userRole",$value['role']);
                    header("Location: index.php");
                }else{
                    echo "<span style='color: red;font-size: 18px;'>NO result Found</span>";
                }
            }else{
                echo "<span style='color: red;font-size: 18px;'>Username OR Password not matched!!!</span>";
            }
        }

        ?>
        <form action="login.php" method="post">
            <h1>Forgot Password</h1>
            <div>
                <input type="text" placeholder="Enter Email Address..." required="" name="username"/>
            </div>
            <div>
                <input type="submit" value="Send" />
            </div>
        </form><!-- form -->
        <div class="button">
            <a href="forgetpass.php">Forgot Password!!!!</a>
        </div>
        <div class="button">
            <a href="#">Complete Project</a>
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>