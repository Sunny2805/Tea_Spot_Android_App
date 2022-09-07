<?php include("header.php");?>

    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Order</h3>
		
        <!-- BASIC FORM VALIDATION -->
		
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form"  action="" method="post" class="form-horizontal style-form">
                
				
 </form>
 



<?php
$con=new PDO("mysql:dbname=tea spot","root","");


$rs=$con->query("select *From `order` o,user u where o.User_id=u.User_id order by Order_id desc");


?>
			  
			  <div class="content-panel">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User Name</th>
					<th>Order Date</th>
					<th>Order Status</th>
					<th>Address</th>
          <th>Phone</th>
          
					<th>Payment Mode</th>
					<th>Remark</th>
          <th>Delivery Boy</th>
          
					
                        </tr>
                    </thead>
            <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>

<td><?php echo $rd["Order_id"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo explode(" ",$rd["Order_date"])[0]; ?></td>
<td><?php echo $rd["Order_Status"];?></td>
<td><?php echo $rd["Delivery_address"];?></td>
<td><?php echo $rd["Phone_No"];?></td>
<td><?php echo $rd["Paymentmode"];?></td>
<td><?php echo $rd["Remark"];?></td>
<td><?php

   if($rd["Deliveryboy_id"]=="0")
   {
      echo "Not Assign";
   }
   else
   {
  $rsname=$con->query("select *from deliveryboy where Deliveryboy_id='".$rd["Deliveryboy_id"]."'");
   $rdname=$rsname->fetch();
    echo $rdname["Name"];
   }
 ?></td>

<td><a href='orderdetails.php?x=<?php echo $rd["Order_id"];?>' class="btn btn-danger btn-xs">Order Details</a></td>

  <?php
    if($rd["Order_Status"]=="New")
  {
  ?>
<td><a href='status.php?x=<?php echo $rd["Order_id"];?>&y=Confirm' class="btn btn-danger btn-xs">Confirm</a></td>
 <?php
  }
  else if($rd["Order_Status"]=="Confirm")
  {
 ?>
<td><a href='status.php?x=<?php echo $rd["Order_id"];?>&y=Prepared' class="btn btn-danger btn-xs">Prepared</a></td>
 <?php
 
  }
  else if($rd["Order_Status"]=="Prepared")
  {
 ?>
<td><a href='orderdetails.php?x=<?php echo $rd["Order_id"];?>' class="btn btn-danger btn-xs">Delivered</a></td>
 <?php
    
  }
  else
  {
    ?>
    <td></td>
    <?php
  }
 ?>


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






