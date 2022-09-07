<?php
 
 $uid=$_REQUEST["uid"];
 $adr=$_REQUEST["address"];
 $r=$_REQUEST["remark"];
 
 $dt=Date('Y-m-d h:i:sa');
 
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into `order`(User_id,Order_date,Order_Status,Delivery_address,Deliveryboy_id,Paymentmode,Remark)
 values('$uid','$dt','New','$adr','0','Cash','$r')");

 $oid=$con->lastInsertId();
 $rs=$con->query("select *from cart where User_id='$uid'");
 
 while($rd=$rs->fetch())
 {
	$con->query("insert into order_details(Order_id,Item_id,Qty) values('$oid','".$rd["Item_id"]."','".$rd["Qty"]."')"); 
 }
 $con->query("delete from cart where User_id='$uid'");
 
$arr=Array("msg"=>"Order Place Successfully");
echo json_encode($arr);
?>