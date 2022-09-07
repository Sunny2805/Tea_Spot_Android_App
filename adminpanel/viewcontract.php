<?php include("header.php");?>

    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Contract</h3>
		
        <!-- BASIC FORM VALIDATION -->
		
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form"  action="" method="post" class="form-horizontal style-form">
                
				
 </form>
 



<?php
$con=new PDO("mysql:dbname=tea spot","root","");


$rs=$con->query("select *From `contract` o,user u where o.User_id=u.User_id");


?>
			  
			  <div class="content-panel">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
					<th>Office Name</th>
					<th>Address</th>
          <th>Phone</th>
          <th>Contract Start Date</th>
          <th>Status</th>
					
          <th></th>
          <th></th>
                        </tr>
                    </thead>
            <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>

<td><?php echo $rd["Contract_id"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Office_Name"];?></td>
<td><?php echo $rd["Address"];?></td>
<td><?php echo $rd["Phone_No"];?></td>
<td><?php echo explode(" ",$rd["Start_Date"])[0]; ?></td>
<td><?php echo $rd["Status"]; ?></td>

<td><a href='contractorder.php?x=<?php echo $rd["Contract_id"];?>' class="btn btn-danger btn-xs">Order</td>

<td><a href='payment.php?x=<?php echo $rd["Contract_id"];?>' class="btn btn-danger btn-xs">Payment</td>

</tr>

<?php
}
?>
                </tbody>
              </table>

</div>
   
        </div>
		    </div>
			  
                </section>
</section>
<?php include("footer.php");?>






