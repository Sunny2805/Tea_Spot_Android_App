<?php

$id=$_GET["z"];
$x=$_GET["x"];
$y=$_GET["y"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("delete from  item_order where Item_Order_id='$id'");
header ("Location:contractorderdetails.php?x=".$x."&y=".$y);

	?>