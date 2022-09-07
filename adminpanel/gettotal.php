<?php session_start();
$m=$_GET["m"];
$y=$_GET["y"];
$cid=$_GET["cid"];

$str=$m." 1,".$y;

$l = date('Y-m-t', strtotime($str));
$s=date('Y-m-01',strtotime($y."-".$m."-1"));

$cn=new PDO("mysql:dbname=tea spot","root","");

$rs=$cn->query("select i.Price,o.Qty from item_order o,item i where o.item_id=i.item_id and Contract_Transaction_id in(select Contract_Transaction_id from contract_transaction where Contract_id='$cid' and Transaction_Date>='$s' and Transaction_Date<='$l')");
$t=0;
while($rd=$rs->fetch())
{
//	echo $rd["Price"];
	$t=$t+($rd["Price"]*$rd["Qty"]);
}
echo $t;






?>