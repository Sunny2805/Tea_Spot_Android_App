<?php
$uid=$_REQUEST["uid"];
$con=new PDO("mysql:dbname=tea spot","root","");
 $rs=$con->query("select *from `order` where User_id='$uid'");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
	 if($rd["Deliveryboy_id"]!="0")
	 {
	 
	 $rsd=$con->query("select *from deliveryboy where Deliveryboy_id='".$rd["Deliveryboy_id"]."'");
	 $rdd=$rsd->fetch();
$arr[$i]=Array("O_id"=>$rd["Order_id"],"U_id"=>$rd["User_id"],"O_date"=>explode(".",$rd["Order_date"])[0],"Order_Status"=>$rd["Order_Status"],"D_address"=>$rd["Delivery_address"]
               ,"P_mode"=>$rd["Paymentmode"],"Remark"=>$rd["Remark"],"Deliveryboy"=>$rdd["Name"],"dphone"=>$rdd["Phone"]);
	 }
	 else
	 {
		 
$arr[$i]=Array("O_id"=>$rd["Order_id"],"U_id"=>$rd["User_id"],"O_date"=>explode(".",$rd["Order_date"])[0],"Order_Status"=>$rd["Order_Status"],"D_address"=>$rd["Delivery_address"]
               ,"P_mode"=>$rd["Paymentmode"],"Remark"=>$rd["Remark"],"Deliveryboy"=>"Not Assign","dphone"=>"Not Assign");
		 
	 }
	 
			   $i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>