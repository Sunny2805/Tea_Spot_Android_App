
<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$id=$_POST["id"];
$na=$_POST["t1"];
$pr=$_POST["t2"];
$ct=$_POST["t3"];
$dc=$_POST["t4"];

if($_FILES["t5"]["name"]=="")
{
$con->query("update  Item set Item_Name='$na' ,Price='$pr' ,Category_id='$ct' ,Description='$dc' where Item_id='$id'");
}
else
{
$path="photo/".$_FILES["t5"]["name"];
move_uploaded_file($_FILES["t5"]["tmp_name"],$path);
$con->query("update Item set Item_Name='$na' ,Price='$pr' ,Category_id='$ct' ,Description='$dc',photo='$path' where Item_id='$id'");
}
header ("Location:item.php");
?>




?>