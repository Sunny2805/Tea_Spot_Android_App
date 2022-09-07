<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from order");
$arr=Array();
$i=0;
while($rd=$qr->fetch())
{
$arr[$i]=Array("oid"=>$rd["Order_id"],"oname"=>$rd["User_id"],"odate"=>$rd["Order_date"],"ostatus"=>$rd["Order_Status"],"dbaddress"=>$rd["Delivery_address"],"dbid"=>$rd["Deliveryboy_id"],"opaymentmode"=>$rd["Paymentmode_id"],"oremark"=>$rd["Remark"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>