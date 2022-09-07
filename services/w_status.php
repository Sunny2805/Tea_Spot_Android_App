<?php
 
 $cid=$_REQUEST["cid"];
 
 
$con=new PDO("mysql:dbname=tea spot","root","");

$con->query("update contract set Status='Deactive' where Contract_id='$cid'");
$arr=Array("msg"=>"Status Chanaged Successfully");
echo json_encode($arr);
?>