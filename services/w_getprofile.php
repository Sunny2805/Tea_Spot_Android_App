<?php
$uid=$_REQUEST["uid"];


$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from user where User_id='$uid'");
if($rd=$rs->fetch())
{
$arr=Array("msg"=>"valid","uid"=>$rd["User_id"],"name"=>$rd["Name"],"address"=>$rd["Address"],"area_id"=>$rd["Area_id"],"phone_no"=>$rd["Phone_No"],"email_id"=>$rd["Email_id"],"password"=>$rd["Password"]);
}
else
{
$arr=Array("msg"=>"invalid");
}
echo json_encode($arr);
?>