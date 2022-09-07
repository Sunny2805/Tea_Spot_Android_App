<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$id=$_POST["id"];
$na=$_POST["t1"];

if($_FILES["t2"]["name"]=="")
{
$con->query("update  category set Name='$na' where Category_id='$id'");
}
else
{
$path="photo/".$_FILES["t2"]["name"];
move_uploaded_file($_FILES["t2"]["tmp_name"],$path);
$con->query("update category set Name='$na',photo='$path' where Category_id='$id'");
}
header ("Location:category.php");
?>