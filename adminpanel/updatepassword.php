<?php session_start();
$op=$_POST["t1"];
$np=$_POST["t2"];
$id=$_SESSION["id"];

$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from admin where Admin_id='$id' and Password='$op'");
if($rd=$rs->fetch())
{
$con->query("update admin set Password='$np' where Admin_id='$id'");
header ("Location:changepassword.php?x=1");
}
else
{
header ("Location:changepassword.php?x=0");
}

?>