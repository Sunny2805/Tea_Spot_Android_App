<?php  
	$id=$_POST["id"];
	$na=$_POST["t1"];
	$e=$_POST["t2"];
	$p=$_POST["t3"];
	
	$cn=new PDO("mysql:dbname=tea spot","root","");
    $cn->query("update admin set Name='$na',Password='$p',Emailid='$e' where admin_id='$id'");
	
    header("Location:admin.php"); 
?>
