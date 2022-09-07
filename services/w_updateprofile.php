<?php
  $id=$_REQUEST["id"];
 $na=$_REQUEST["name"];
 $ad=$_REQUEST["address"];
 $aid=$_REQUEST["areaid"];
 $ph=$_REQUEST["phone"];
 
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("update user set Name='$na',Address='$ad',Area_id='$aid',
Phone_No='$ph' where User_id='$id'");

$arr=Array("msg"=>"Updated Successfully");
echo json_encode($arr);
?>