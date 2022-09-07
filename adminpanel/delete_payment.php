<?php
$oid=$_GET["x"];
$cid=$_GET["y"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from contract_payment where Contract_Payment_id='$oid'");
header ("Location:payment.php?x=".$cid);

	?>