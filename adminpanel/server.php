<?php
$con=new PDO("mysql:dbname=tea spot","root","");



$sql = "SELECT count(*) FROM `order`"; 
$result = $con->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
echo $number_of_rows;
?>