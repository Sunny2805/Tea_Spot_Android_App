<?php
$uid=$_REQUEST["uid"];
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from contract c,user u,area a where c.User_id=u.User_id and a.Area_id=c.Area_id and c.User_id='$uid'");
$arr=Array();
$i=0;
while($rd=$rs->fetch())
{
$arr[$i]=Array("Contract_id"=>$rd["Contract_id"],"uid"=>$rd["User_id"],"Office_Name"=>$rd["Office_Name"],"address"=>$rd["Address"],"area"=>$rd["Area_Name"],
"date"=>$rd["Start_Date"],"status"=>$rd["Status"]);
 $i++;
}
$data=Array("msg"=>$arr);
echo json_encode($data);
?>