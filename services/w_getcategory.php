<?php
 
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from category");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
$arr[$i]=Array("cid"=>$rd["Category_id"],"cname"=>$rd["Name"],"photo"=>$rd["Photo"]);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>