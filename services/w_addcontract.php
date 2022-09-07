<?php
 
 $uid=$_REQUEST["uid"];
 $ofice_Name=$_REQUEST["Office_Name"];
 $address=$_REQUEST["Address"];
 $area_id=$_REQUEST["Area_id"];
 $dt=$_REQUEST["dt"];
 
 
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into contract(User_id,Office_Name,Address,Area_id,Start_date,Status)
 values('$uid','$ofice_Name','$address','$area_id','$dt','Active')");

$arr=Array("msg"=> "Register Contract succesfully");
echo json_encode($arr);
?>