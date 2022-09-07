<?php  
	$cn=new PDO("mysql:dbname=tea spot","root","");

	$id=$_POST["id"];
	
	$name=$_POST["t1"];
    $add=$_POST["t2"];
    $phone=$_POST["t4"];
    $area_id=$_POST["t3"];



if($_FILES["t5"]["name"]=="")
	 {
$cn->query("update deliveryboy set Name='$name',Address='$add',Area_id='$area_id',Phone='$phone' where Deliveryboy_id='$id'");
}
 else
	 {
$path="photo/".$_FILES["t5"]["name"];
move_uploaded_file($_FILES["t5"]["tmp_name"],$path);
$cn->query("update deliveryboy set Name='$name',Address='$add',Area_id='$area_id',Phone='$phone',Photo='$path' where Deliveryboy_id='$id'");
}
	header("Location:deliveryboy.php"); 
?>