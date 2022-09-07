<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from admin");
$arr=Array();
$i=0;
while($rd=$qr->fetch())
{
$arr[$i]=Array("adm"=>$rd["Admin_id"],"adname"=>$rd["Name"],"adpassword"=>$rd["Password"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>