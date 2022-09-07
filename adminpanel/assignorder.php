<?php 
$did=$_POST["t1"];
$oid=$_POST["oid"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("update `order` set Order_Status='Delivered', Deliveryboy_id='$did' where Order_id='$oid'");
header("Location:orderdetails.php?x=".$oid);
?>