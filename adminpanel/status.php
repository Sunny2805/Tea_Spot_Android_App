<?php 
$oid=$_GET["x"];
$s=$_GET["y"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("update `order` set Order_Status='$s' where Order_id='$oid'");
header("Location:order.php");
?>