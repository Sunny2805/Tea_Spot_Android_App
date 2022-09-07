<?php
 
 $uid=$_REQUEST["User_id"];
 $itemid=$_REQUEST["Item_id"];
 $qty=$_REQUEST["Qty"];
 
 
$con=new PDO("mysql:dbname=tea spot","root","");

$rs=$con->query("select *from cart where User_id='$uid' and Item_id='$itemid'");
if($rd=$rs->fetch())
{
	$cnt=$rd["Qty"];
	$cnt=$cnt+$qty;
	$con->query("update cart set Qty='$cnt' where User_id='$uid' and Item_id='$itemid'");

}
else
{
$con->query("insert into cart(User_id,Item_id,Qty) values('$uid','$itemid','$qty')");
}
$arr=Array("msg"=>"Added Successfully");
echo json_encode($arr);
?>