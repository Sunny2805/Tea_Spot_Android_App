<?php  
	$id=$_POST["id"];
	$na=$_POST["t1"];

	$cn=new PDO("mysql:dbname=tea spot","root","");
    $cn->query("update area set Area_Name='$na' where Area_id='$id'");
	
    header("Location:area.php"); 
?>
