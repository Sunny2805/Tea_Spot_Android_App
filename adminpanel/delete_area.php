<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  area where Area_id='$id'");
header ("Location:area.php");


?>