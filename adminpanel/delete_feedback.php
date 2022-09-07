<?php
$id=$_GET["x"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  feedback where Feedback_id='$id'");
header ("Location:feedback.php");


?>