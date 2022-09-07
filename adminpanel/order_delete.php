<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  order where _id='$id'");
header ("Location:order.php");


?>