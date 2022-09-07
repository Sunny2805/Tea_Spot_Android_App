
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
  <?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rsa=$cn->query("select *from contract");
  ?>		 
		 
        <h3><i class="fa fa-angle-right"></i>Date & Contract Wise Contract Order Report</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
             
                <form role="form" id="category" name="category" action="" method="POST" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Office Name</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <select  name="t1" required  style="width:500px" class="form-control">
                    <?php
                     while($rda=$rsa->fetch())
                     {
                      ?>
                        <option value='<?php echo $rda["Contract_id"] ?>'><?php echo $rda["Office_Name"]; ?></option>
                      <?php
                     }
                    ?>
                    <select>
                  </div>
                </div>  

                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">To</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <input type="date"  name="t2" required  style="width:500px" class="form-control">
                    </div>

                </div>  
         
        <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">From</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <input type="date"  name="t3" required  style="width:500px" class="form-control">
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
$rs=$cn->query("select *From contract_transaction c,item_order a,item i where c.Contract_Transaction_id=a.Contract_Transaction_id and a.Item_id=i.Item_id and c.Contract_id='".$_POST["t1"]."'");


?>



			  
<div class="content-panel">
         <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
    
        <thead>
            <tr>
                <th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Order Time</th>
        <th>Date</th>
        
                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>
<td><?php echo $rd["Item_Name"];?></td>
<td><?php echo $rd["Price"];?></td>
<td><?php echo $rd["Qty"];?></td>
<td><?php echo $rd["ordertime"];?></td>
<td><?php echo $rd["Transaction_Date"];?></td>



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


	
