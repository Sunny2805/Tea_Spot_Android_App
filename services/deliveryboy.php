<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from deliveryboy");
$arr=Array();
$i=0;
while($rd=$qr->fetch())
{
$arr[$i]=Array("dbid"=>$rd["Deliveryboy_id"],"dbname"=>$rd["Name"],"dbaddress"=>$rd["Address"],"dbareaid"=>$rd["Area_id"],"dbphone"=>$rd["Phone"],"dbphoto"=>$rd["Photo"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>