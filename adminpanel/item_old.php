<?php include("header.php");?>
	<?php

$con=new PDO("mysql:dbname=tea spot","root","");
$rsa=$con->query("select *from category");
?>


    
    <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i> Item</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
                 
	  			 
	             <label class="col-lg-2 control-label"> Item Name:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="Enter The Item Name" id="item_name" name="t1" class="form-control" required>
                    
                  </div>
                </div>
				 
				 
				 
				 
               
                <div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Price:</label>
                  <div class="col-lg-10"> 
                    <input type="text" placeholder="Enter The Price" id="item_Price" name="t2" class="form-control" required>
                   
                  </div>
                </div>
				
				<!--<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Category_Id:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="Enter The Category_Id" id="item_Category_Id" name="t3" class="form-control">
			
                  </div>
                </div>-->
				<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Category_Id:</label>
                  <div class="col-lg-10">
                    <!--<input type="email" placeholder="" id="email2" class="form-control">-->
					<select placeholder="Select Category"  name="t3" class="form-control" required>
                     <?php
					   while($rda=$rsa->fetch())
					   {
					 ?>
					<option  required value='<?php echo $rda["Category_id"]; ?>' ><?php echo $rda["Name"]; ?></option>
                     <?php
					   }
					 ?>
                    </select>   
                   
                 </div>
           </div>
				
				
				
				
				
				
				
				<div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Description:</label>
                  <div class="col-lg-10">
                    <textarea  rows="5" cols="50" placeholder="Enter The Description" id="item_Description" name="t4" required class="form-control"></textarea>
                   </div>
                </div>
				
				
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
<?php

$con=new PDO("mysql:dbname=tea spot","root","");

?>

<?php
if(isset($_POST["t1"]))
{
$name=$_POST["t1"];
$price=$_POST["t2"];
$category=$_POST["t3"];
$disp=$_POST["t4"];

$path="photo/".$_FILES["t5"]["name"];
move_uploaded_file($_FILES["t5"]["tmp_name"],$path);
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into item(Item_Name,Price,Category_Id,Description,Photo)
values('$name','$price','$category','$disp','$path')");
echo "Insert data";
	}
?>

<!--------------------------------DISPLAY--TABLE----------------------------------->


<?php
$rs=$con->query("SELECT *FROM item ,category where item.Category_id = category.Category_id");

?>
			  
<div class="content-panel">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
				<th>Price</th>
				<th>Category</th>
				<th>Description</th>
				<th>Photo</th>
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
<td><?php echo $rd["Item_id"];?></td>
<td><?php echo $rd["Item_Name"];?></td>
<td><?php echo $rd["Price"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Description"];?></td>
<td><img src='<?php echo $rd[5];?>' width="50" height="50"></td>
<!--<td><a href='#'>Delete</a></td>-->

<!--<td><a href='#'>Edit</a></td>-->
<td><a href='edit_item.php?x=<?php echo $rd["Item_id"];?>' class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
<td><a href='delete_item.php?x=<?php echo $rd["Item_id"];?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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
			  
    </section>
</section>
	<?php include("footer.php");?>
    