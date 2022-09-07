<?php session_start();
$l=$_POST["t1"];
$p=$_POST["t2"];

$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from admin where Name='$l' and Password='$p'");
if($rd=$rs->fetch())
{
 $_SESSION["id"]=$rd["Admin_id"];
header ("Location:welcome.php");
}
else
{
header ("Location:login.php?x=1");
}

?>