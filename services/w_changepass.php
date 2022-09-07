<?php
 $uid=$_REQUEST["uid"];
 $op=$_REQUEST["op"];
 $np=$_REQUEST["np"]; 
 
 $con=new PDO("mysql:dbname=tea spot","root","");
 $rs=$con->query("select *from user where User_id='$uid' and  Password='$op'");
if($rd=$rs->fetch())
{
 $con->query("update user set Password='$np' where User_id='$uid'");
$arr=Array("msg"=>"Your Password Change Successfully.");
}
else
{
$arr=Array("msg"=>"Invalid Old Password");
}
echo json_encode($arr);
?>
