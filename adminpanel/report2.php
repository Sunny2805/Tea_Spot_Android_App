
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
		 
		 
        <h3><i class="fa fa-angle-right"></i>All User Report</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
             



	  
<?php

$cn=new PDO("mysql:dbname=tea spot","root","");
$rs=$cn->query("select *From user d,area a where d.Area_id=a.Area_id");

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



</tr>
<?php
}
?>
                                </tbody>
                          </table>
                      </div>
                 </div>
               </div>
             </div>
            </div>
		</div>
     </section>
</section>
	  
	  
            
			
<?php include("footer_report.php");?>


	
