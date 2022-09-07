<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  item where Item_id='$id'");
header ("Location:item.php");


?>