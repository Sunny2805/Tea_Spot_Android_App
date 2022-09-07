
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
  <?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rsa=$cn->query("select *from area");
  ?>		 
		 
        <h3><i class="fa fa-angle-right"></i>Date Wise Order Report</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
             
                <form role="form" id="category" name="category" action="" method="POST" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">To</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <input type="date"  name="t1" required  style="width:500px" class="form-control">
                    </div>

                </div>  
         
        <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">From</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <input type="date"  name="t2" required  style="width:500px" class="form-control">
                    </div>
                    
                </div>  
         
        
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
             </div>
       </div>
</form>




	  
<?php

 if(isset($_POST["t1"]))
{  
$rs=$cn->query("select *From user d,`order` o where d.User_id=o.User_id and o.Order_date>='".$_POST["t1"]."' and o.Order_date<='".$_POST["t2"]."'");


?>



			  
<div class="content-panel">
                <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
    <thead>
            <tr>
              <th>Order Id</th>

              <th>Order Date</th>
                <th>Name</th>
                <th>Contact</th>

				<th>Address</th>
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
<td><?php echo explode(".", $rd["Order_date"])[0];?></td>

<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Phone_No"];?></td>

<td><?php echo $rd["Delivery_address"];?></td>
<td><?php echo $rd["Remark"];?></td>
<td>
     <?php
        if($rd["Deliveryboy_id"]=="0")
        {
          echo "<font color='red'>Not Assign</font>";
        }
        else
        {
          $rsd=$cn->query("select *from deliveryboy where Deliveryboy_id='".$rd["Deliveryboy_id"]."'");
          $rdd=$rsd->fetch();
          echo $rdd["Name"];
        }
     ?>

</td>



</tr>

 <tr>
   <td colspan="7"></td>
  </tr>

<tr>
   <td></td>
   <td colspan="6">
      
    <?php
      $rsod=$cn->query("select *From item i,order_details od where i.Item_id=od.Item_id and od.Order_id='".$rd["Order_id"]."'");
    ?>


    <table class="table">
        <thead>
            <tr>

        <th>Product Name</th>
        <th>Price</th>
        <th>Quantity</th>
        
                 </tr>
        </thead>
     <tbody>
      <?php
         while($rdod=$rsod->fetch())
         {
          ?>
          <tr>
           <td><?php echo $rdod["Item_Name"]; ?></td>
           <td><?php echo $rdod["Price"]; ?></td>
           <td><?php echo $rdod["Qty"]; ?></td>
           
          </tr>

          <?php
         }
      ?>
      </tbody>
    </table>

   </td>
 
</tr>
 <tr>
   <td colspan="7"></td>
  </tr>
  
<?php
}
?>
                                </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                      <?php
}
                      ?>
                 </div>
            </div>
		</div>
     </section>
</section>
	  
	  
            
			
<?php include("footer_report.php");?>


	
