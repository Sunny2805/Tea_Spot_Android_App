<?php
$Contract_Transaction_id=$_REQUEST["Contract_Transaction_id"];
$Item_id=$_REQUEST["Item_id"];
$Qty=$_REQUEST["Qty"];
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into item_order(Contract_Transaction_id,Item_id,Qty)
 values('$Contract_Transaction_id','$Item_id','$Qty')");

$arr=Array("msg"=>"Take Contract succesfully");
echo json_encode($arr);


?>