<?php
 
 $m=$_REQUEST["m"];
 $y=$_REQUEST["y"];
 $cid=$_REQUEST["cid"];

$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from contract_transaction t,item_order i,item it where t.Contract_Transaction_id=i.Contract_Transaction_id and i.Item_id=it.Item_id and Contract_id='$cid'");

$arr=Array();
$i=0;

while($rd=$rs->fetch())
{
	    

        if(explode("-",$rd["Transaction_Date"])[0]==$y && explode("-",$rd["Transaction_Date"])[1]==$m)
        {

       $arr[$i]=Array("name"=>$rd["Item_Name"],"price"=>$rd["Price"],"qty"=>$rd["Qty"],"otime"=>$rd["ordertime"],"date"=>$rd["Transaction_Date"]);
       $i++;
   }
}

if($m==1)
{
	$m="January";
}
else if($m==2)
{
	$m="February";
}
else if($m==3)
{
	$m="March";
}
else if($m==4)
{
	$m="April";
}
else if($m==5)
{
	$m="May";
}
else if($m==6)
{
	$m="June";
}
else if($m==7)
{
	$m="July";
}
else if($m==8)
{
	$m="August";
}
else if($m==9)
{
	$m="September";
}
else if($m==10)
{
	$m="October";
}
else if($m==11)
{
	$m="November";
}
else if($m==12)
{
	$m="December";
}

$str=$y."-".$m;
$rsp=$con->query("select *From contract_payment where Month='$str' and Contract_id='$cid'");

if($rdp=$rsp->fetch())
{
$data=Array("msg"=>$arr,"paid"=>"Paid","date"=>$rdp["Paymentdate"]);
}
else
{
$data=Array("msg"=>$arr,"paid"=>"Unpaid");

}
echo json_encode($data);
?>