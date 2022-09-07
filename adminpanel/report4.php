
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
  <?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rsa=$cn->query("select *from area");
  ?>		 
		 
        <h3><i class="fa fa-angle-right"></i>Date Wise User Registration Report</h3>
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
$rs=$cn->query("select *From user d,area a where d.Area_id=a.Area_id and d.Reg_Date>='".$_POST["t1"]."' and d.Reg_Date<='".$_POST["t2"]."'");


?>



			  
<div class="content-panel">
               <div class="card-body">
              <div class="table-responsive">
              <table id="example" class="table table-bordered">
     <thead>
            <tr>
                <th>Name</th>
				<th>Address</th>
				<th>Area</th>
				<th>Phone</th>
        <th>Emailid</th>
        <th>Registration Date</th>
        
                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Address"];?></td>
<td><?php echo $rd["Area_Name"];?></td>
<td><?php echo $rd["Phone_No"];?></td>
<td><?php echo $rd["Email_id"];?></td>
<td><?php echo $rd["Reg_Date"];?></td>



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


	
