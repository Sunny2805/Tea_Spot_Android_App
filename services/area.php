<?php
$con=new PDO("mysql:dbname=tea spot","root","");
$qr=$con->query("select *from area");
$arr=Array();
$i=1;
$arr[0]=Array("aid"=>"0","aname"=>"--Select Area--");
while($rd=$qr->fetch())
{
$arr[$i]=Array("aid"=>$rd["Area_id"],"aname"=>$rd["Area_Name"]);
$i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>