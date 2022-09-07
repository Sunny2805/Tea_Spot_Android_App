<?php
 
 $cid=$_REQUEST["cid"];
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from contract where Contract_id='$cid'");
$rd=$rs->fetch();

$y=explode("-",$rd["Start_Date"])[0];
$m=explode("-",$rd["Start_Date"])[1];
$dt=date('Y-m-d');
$arr=Array();
$i=0;

if(explode("-",$dt)[0]==$y)
{
	while($m<=explode("-", $dt)[1])
	{
       $arr[$i]=Array("year"=>$y,"month"=>$m);
       $m=$m+1;
       $i++;
    }
}


$data=Array("msg"=>$arr);
echo json_encode($data);
?>