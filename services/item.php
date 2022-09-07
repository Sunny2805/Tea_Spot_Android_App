<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from item");
$arr=Array();
$i=0;
while($rd=$qr->fetch())
{
$arr[$i]=Array("Iid"=>$rd["Item_id"],"Iname"=>$rd["Item_Name"],"Iprice"=>$rd["Price"],"Icategory"=>$rd["Category_id"],"Idescription"=>$rd["Description"],"Iphoto"=>$rd["Photo"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>