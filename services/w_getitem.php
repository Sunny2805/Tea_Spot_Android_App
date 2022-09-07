<?php
 $cid=$_REQUEST["cid"];
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from item where Category_id='$cid'");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
$arr[$i]=Array("i_id"=>$rd["Item_id"],"i_name"=>$rd["Item_Name"],"i_price"=>$rd["Price"],"c_id"=>$rd["Category_id"],"i_desc"=>$rd["Description"],"i_photo"=>$rd["Photo"]);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>