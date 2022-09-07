<?php
$id=$_REQUEST["uid"];
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from  cart,item where cart.item_id=item.item_id and cart.User_id='$id'");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
$arr[$i]=Array("cartid"=>$rd["Cart_id"],"item_name"=>$rd["Item_Name"],"Price"=>$rd["Price"],"photo"=>$rd["Photo"],"qty"=>$rd["Qty"]);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>