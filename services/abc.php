<?php
 $uid=$_REQUEST["uid"];
 $pa=$_REQUEST["pa"];
 $con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *from user where User_id='$uid' and  Password='$pa'");
if($rd=$rs->fetch())
	{
		$rs=$con->query("update user set Password='$np',Name='',Address='', Area_id=''
		 where User_id='$uid'");	
  $arr=Array("msg"=>"Your Password Chanage Successfully.");
		
 }
else
	{
		$arr=Array("msg"=>"Your Password not Chanage.");
		
 }
 echo json_encode($arr);
?>
	User_idPrimary	int(10)			No	None		AUTO_INCREMENT	Change Change	Drop Drop	
More More
	2	Name	varchar(30)	latin1_swedish_ci		No	None			Change Change	Drop Drop	
More More
	3	Address	varchar(50)	latin1_swedish_ci		No	None			Change Change	Drop Drop	
More More
	4	Area_id	int(10)			No	None			Change Change	Drop Drop	
More More
	5	Phone_No	varchar(10)	latin1_swedish_ci		No	None			Change Change	Drop Drop	
More More
	6	Email_id	varchar(50)	latin1_swedish_ci		No	None			Change Change	Drop Drop	
More More
	7	Password	varchar(10)	latin1_swedish_ci		No	None			Change Change	Drop Drop	
More More
	8	Reg_Date