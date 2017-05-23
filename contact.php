<?php include 'inc/header.php';
?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    $fname = mysqli_real_escape_string($db->link, $fm->validation($_POST['firstname']));
    $lname = mysqli_real_escape_string($db->link, $fm->validation($_POST['lastname']));
    $email = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
    $body = mysqli_real_escape_string($db->link, $fm->validation($_POST['body']));

    $error="";

    if(empty($fname)){
        $error="First name must not be empty";
    }elseif(empty($lname)){
        $error="Last name must not be empty";
    }elseif (empty($email)){
        $error="Email name must not be empty";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error="Invalid Email Address";
    }elseif (empty($body)){
        $error="Body name must not be empty";
    }else{


        $query="insert into tbl_contact(firstname,lastname,email,body) values('$fname','$lname','$email','$body')";
        $insert=$db->insert($query);
        if ($insert){
            $msg="Message Sent Successfully";
        }else{
            $error="Message field must not be empty";
        }
    }
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
                <?php
                if(isset($error)){
                    echo "<span style='color: red;font-size: 18px;'>$error</span>";
                }
                if(isset($msg)){
                    echo "<span style='color: green;font-size: 18px;'>$msg</span>";
                }
                ?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
            </form>
 </div>

		</div>
        <?php include 'inc/sidebar.php'; ?>
        <?php include 'inc/footer.php'; ?>

