<?php
$User_id=$_REQUEST["User_id"];
$Feedback=$_REQUEST["Feedback"];
$Rate=$_REQUEST["Rate"];
$Feedback_Date=date('Y-m-d');
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("Insert into feedback(User_id,Feedback,Rate,Feedback_Date)
values('$User_id','$Feedback','$Rate','$Feedback_Date')");

$arr=Array("msg"=>"Added Successfully");
echo json_encode($arr);
?>