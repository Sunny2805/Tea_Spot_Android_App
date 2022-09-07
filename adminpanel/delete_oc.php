<?php
$oid=$_GET["x"];
$cid=$_GET["y"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  contract_transaction where Contract_Transaction_id='$oid'");
header ("Location:contractorder.php?x=".$cid);

	?>