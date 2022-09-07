<?php
$name=$_REQUEST["name"];
$email=$_REQUEST["email"];
$address=$_REQUEST["address"];
$city=$_REQUEST["city"];

$con=new PDO("mysql:dbname=nk","root","");
$con->query("insert into nilesh(name,email,address,city) values('$name','$email','$address','$city')");

$arr=Array("msg"=>"Added Successfully");
echo json_encode($arr);

?>