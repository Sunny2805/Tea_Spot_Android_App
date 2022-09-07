<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  category where category_id='$id'");
header ("Location:category.php");


?>