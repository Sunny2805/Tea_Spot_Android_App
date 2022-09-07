<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  deliveryboy where Deliveryboy_id='$id'");
header ("Location:deliveryboy.php");


?>