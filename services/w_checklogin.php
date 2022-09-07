<?php
 $l=$_REQUEST["l"];
 $p=$_REQUEST["p"];
 
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from user where Email_id='$l' and Password='$p'");
if($rd=$rs->fetch())
{
$arr=Array("msg"=>"valid","uid"=>$rd["User_id"],"name"=>$rd["Name"]);
}
else
{
$arr=Array("msg"=>"invalid");
}
echo json_encode($arr);
?>