<?php
include("config.php");
$con=mysqli_connect("localhost","root","","rp");

if(!isset($_GET["code"])) {
	exit("can't find a page");
}

$code = $_GET["code"];

$getEmailQuery =mysqli_query($con,"SELECT email FROM rp WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery)== 0) {
	exit("can't find a page");
}

if(isset($_POST("pass"))) {
	$pw =$_POST["pass"];
	$pw =md5($pw);

	$row =mysqli_fetch_array($getEmailQuery);
	$email =$row["email"];

	$query =mysqli_query($con, "UPDATE user SET password='$pw' WHERE email='$email'");
	if ($query) {
		$query =mysqli_query($con,"DELETE FROM rp WHERE code='$code'");
		   exit("password updated");
		
		}
		else{
			exit("something went wrong");
		}
}
?>
<form method="POST">
	<input type="text" name="pass" placeholder="new password">
	<br>
	<input type="submit" name="submit" value="update password">
	
</form>