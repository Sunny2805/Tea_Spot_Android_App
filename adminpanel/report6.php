
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
  <?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rsa=$cn->query("select *from category");
  ?>		 
		 
        <h3><i class="fa fa-angle-right"></i>Category Wise Item Report</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
             
                <form role="form" id="category" name="category" action="" method="POST" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Category</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <select  name="t1" required  style="width:500px" class="form-control">
                    <?php
                     while($rda=$rsa->fetch())
                     {
                      ?>
                        <option value='<?php echo $rda["Category_id"] ?>'><?php echo $rda["Name"]; ?></option>
                      <?php
                     }
                    ?>
                    <select>
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
$rs=$cn->query("select *From item i,category a where i.Category_id=a.Category_id and i.Category_id='".$_POST["t1"]."'");


?>



			  
<div class="content-panel">
       <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
          <thead>
            <tr>
                <th>Item Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Description</th>
        
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
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Description"];?></td>



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


	
