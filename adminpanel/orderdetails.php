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

$id=$_REQUEST["x"];

$rs=$con->query("select *From `order` o,user u where o.User_id=u.User_id  and o.Order_id='$id'");


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
<td><?php echo explode(" ",$rd["Order_date"])[0];?></td>
<td><?php echo $rd["Order_Status"];?></td>
<td><?php echo $rd["Delivery_address"];?></td>
<td><?php echo $rd["Phone_No"];?></td>
<td><?php echo $rd["Paymentmode"];?></td>
<td><?php echo $rd["Remark"];?></td>


</tr>

<?php
  $did=$rd["Deliveryboy_id"];
}
?>
                </tbody>
              </table>


</div>
 
 <br>
 <br>
 >Order Details
 <br>
 <br>
 <?php

   $rsd=$con->query("select *from order_details od,item i where od.Item_id=i.Item_id and od.Order_id='$id'");

 ?>


        <div class="content-panel">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          
                        </tr>
                    </thead>
            <tbody>

                <?php
                 $cnt=1;
                 $t=0;
                   while($rdd=$rsd->fetch())
                   {

                    ?>
                    <tr>
                       <td><?php echo $cnt; ?></td>
                       <td><?php echo $rdd["Item_Name"]; ?></td>
<td><?php echo $rdd["Price"]; ?></td>
<td><?php echo $rdd["Qty"]; ?></td>
<td><?php echo $rdd["Qty"]*$rdd["Price"]; ?></td>

                    </tr>
                    <?php
                      $t=$t+($rdd["Qty"]*$rdd["Price"]);
                     $cnt++;
                   }
                ?>

            </tbody>
          </table>
        </div>

 <br>
   <h3>Total Amout: <?php echo $t ?> Rs.</h3>
<br>
<br>

<?php

 if($did=="0")
 {
     $rsd=$con->query("select *from deliveryboy");


?> 
              <form role="form"  action="assignorder.php" method="POST"  class="form-horizontal style-form">
                <input type="hidden" value="<?php echo $id; ?>" name="oid">
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Delivery Boy</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <select name="t1" style="width:400px" required  class="form-control">
                       <?php
                        while($rdd=$rsd->fetch())
                        {
                          ?>
                           <option value='<?php echo $rdd["Deliveryboy_id"]; ?>'><?php echo $rdd["Name"]; ?></option>
                          <?php
                        }
                       ?>
                    </select>
                  </div>
                </div>  
        
        
        
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Assign</button>
             </div>
       </div>
</form>

<?php
 }
 else
 {

   $rsname=$con->query("select *from deliveryboy where Deliveryboy_id='$did'");
   $rdname=$rsname->fetch();
    echo "<h4>This order assign to ".$rdname["Name"]."</h4>";
 }
?>

        </div>
		    </div>
			  
                </section>
</section>
<?php include("footer.php");?>






