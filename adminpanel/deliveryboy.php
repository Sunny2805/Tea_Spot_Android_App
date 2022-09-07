<?php include("header.php");?>
	<?php

$con=new PDO("mysql:dbname=tea spot","root","");
$rsa=$con->query("select *from area");
?>

	
 <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i>Delivery Boy Table</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
                  <label class="col-lg-2 control-label">Name:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="" id="f-name" name="t1" class="form-control" required>
                    
                  </div>
                </div>
               
                <div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Address:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="" id="email2" name="t2" class="form-control" required>
                   
                  </div>
                </div>
				
				<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Area:</label>
                  <div class="col-lg-10">
                    <!--<input type="email" placeholder="" id="email2" class="form-control">-->
					<select placeholder="Select City"  name="t3" class="form-control">
                     <?php
					   while($rda=$rsa->fetch())
					   {
					 ?>
					<option value='<?php echo $rda["Area_id"]; ?>'><?php echo $rda["Area_Name"]; ?></option>
                     <?php
					   }
					 ?>
                    </select>   
                   
                 </div>
           </div>
				
				
				<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Phone:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="(123)123-1234" id="phoneNumber" name="t4" class="form-control" required>
				
                   
                  </div>
                </div>
				
				
				<!--<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Photo:</label>
                  <div class="col-lg-10">
                    <input type="file" name="pic" accept="image/*" id="phoneNumber" name="t5" class="form-control">
				
				
                   
                  </div>
                </div>-->
				<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Photo:</label>
                  <div class="col-lg-10">
                    <!--<input type="file" name="pic" accept="image/*" id="c_photo" name="t2" class="form-control">-->
                      
					  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                  <input type="file"  name="t5" multiple required>
                  </span>
					
					
                   
                  </div>
                </div>
				
				
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
             </div>
        </div>
             
	  
</form>
	  <!----------------------------INSERT**DATA------------------------->
	  
 
<?php
if(isset($_POST["t1"]))
{
$name=$_POST["t1"];
$add=$_POST["t2"];
$phone=$_POST["t4"];
$area_id=$_POST["t3"];

$path="photo/".$_FILES["t5"]["name"];
move_uploaded_file($_FILES["t5"]["tmp_name"],$path);
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into deliveryboy (Name,Address,Phone,Area_id,Photo) values('$name','$add','$phone','$area_id','$path')");
}

?>


    
	
<?php


$rs=$con->query("SELECT *FROM area ,deliveryboy where area.Area_id = deliveryboy.Area_id ");

?>
			  
<div class="content-panel">
    <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name:</th>
					<th>Address:</th>
					<th>Phone:</th>
					<th>Area:</th>
					<th>Photo:</th>
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
<td><?php echo $rd["Deliveryboy_id"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Address"];?></td>
<td><?php echo $rd["Phone"];?></td>
<td><?php echo $rd["Area_Name"];?></td>

<td><img src='<?php echo $rd["Photo"];?>' width="50" height="50"></td>

<!--<td><a href='#'>Delete</a></td>
<td><a href='#'>Edit</a></td>-->
<td><a href='edit_deliveryboy.php?x=<?php echo $rd["Deliveryboy_id"];?>' class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
<td><a href='delete_delivery_boy.php?x=<?php echo $rd["Deliveryboy_id"];?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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