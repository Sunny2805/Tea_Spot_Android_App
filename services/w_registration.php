<?php
 $na=$_REQUEST["name"];
 $ad=$_REQUEST["address"];
 $aid=$_REQUEST["areaid"];
 $ph=$_REQUEST["phone"];
 $e=$_REQUEST["email"];
 $p=$_REQUEST["password"];
 $dt=date('Y-m-d');
 
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into user(Name,Address,Area_id,Phone_No,Email_id,Password,Reg_Date)
 values('$na','$ad','$aid','$ph','$e','$p','$dt')");

$arr=Array("msg"=>"Added Successfully");
echo json_encode($arr);
?>