
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
  <?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rsa=$cn->query("select *from area");
  ?>		 
		 
        <h3><i class="fa fa-angle-right"></i>Status Wise Contract Report</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
             
                <form role="form" id="category" name="category" action="" method="POST" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Status</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <select  name="t1" required  style="width:500px" class="form-control">
                     <option value="Active">Active</option>
                     <option value="Deactive">Deactive</option>
                     
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
$rs=$cn->query("select *From contract c,area a where c.Area_id=a.Area_id and c.Status='".$_POST["t1"]."'");


?>



			  
<div class="content-panel">
        <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
    
        <thead>
            <tr>
                <th>Office Name</th>
				<th>Address</th>
				<th>Area</th>
				<th>Start Date</th>
        <th>Status</th>
        
                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>
<td><?php echo $rd["Office_Name"];?></td>
<td><?php echo $rd["Address"];?></td>
<td><?php echo $rd["Area_Name"];?></td>
<td><?php echo $rd["Start_Date"];?></td>
<td><?php echo $rd["Status"];?></td>



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


	
