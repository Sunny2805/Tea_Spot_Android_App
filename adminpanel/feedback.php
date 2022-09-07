<?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Feedback</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form"  action="" method="post" class="form-horizontal style-form">
                
				
 </form>
  <!----------------------------INSERT**DATA------------------------->			  
<?php

$con=new PDO("mysql:dbname=tea spot","root","");

?>



 <!----------------------------DISPLAY**DATA------------------------->

<?php


$rs=$con->query("select *From feedback,user where user.User_id = feedback.User_id");

?>
			  
			  <div class="content-panel">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>User_Name</th>
					<th>Feedback</th>
					<th>Rate</th>
					<th>Feedback_date</th>
                  </tr>
                </thead>
                <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>

<td><?php echo $rd["Feedback_id"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Feedback"];?></td>
<td><?php echo $rd["Rate"];?></td>
<td><?php echo $rd["Feedback_Date"];?></td>
<td><a href='delete_feedback.php?x=<?php echo $rd["Feedback_id"];?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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






