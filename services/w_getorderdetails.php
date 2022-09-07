<?php
$od_id=$_REQUEST["od_id"];
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from item , order_details where item.Item_id = order_details.Item_id and order_details.Order_id='$od_id'");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
$arr[$i]=Array("odid"=>$rd["Order_details_id"],"oid"=>$rd["Order_id"],"item_name"=>$rd["Item_Name"],"qty"=>$rd["Qty"],"item_photo"=>$rd["Photo"],"i_price"=>$rd["Price"],);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>