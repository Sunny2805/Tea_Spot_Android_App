<?php
$Cart_id=$_REQUEST["Cart_id"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from cart where Cart_id='$Cart_id'");
$arr=Array("msg"=>"Deleted Successfully");
echo json_encode($arr);
?>