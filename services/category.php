<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from category");
$arr=Array();
$i=0;
while($rd=$qr->fetch())
{
$arr[$i]=Array("cid"=>$rd["Category_id"],"cname"=>$rd["Name"],"cphoto"=>$rd["Photo"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>