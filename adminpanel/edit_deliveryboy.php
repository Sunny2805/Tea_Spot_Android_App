<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
  $cn=new PDO("mysql:dbname=tea spot","root","");
  $rscat=$cn->query("select *from area");
  $id=$_GET["x"];
  $rsp=$cn->query("select *From deliveryboy where Deliveryboy_id='$id'");
  $rdp=$rsp->fetch();
  
?>

<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(50)
                    .height(50);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php include("header.php");?>
<?php

$con=new PDO("mysql:dbname=tea spot","root","");
$rsa=$con->query("select *from deliveryboy");
?>

	
 <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i>Delivery Boy Table</h3> 
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" id="update_deliveryboy" name="update_deliveryboy" action="update_deliveryboy1.php" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
                 <input type="hidden" value='<?php echo $rdp["Deliveryboy_id"]; ?>' name="id">
				<div class="form-group">
                  <label class="col-lg-2 control-label">Name:</label>
                  <div class="col-lg-10">
                    <input type="text" value='<?php echo $rdp["Name"]; ?>'placeholder="" id="f-name" name="t1" class="form-control">
                    
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="col-lg-2 control-label">Address:</label>
                  <div class="col-lg-10">
                    <input type="text" value='<?php echo $rdp["Address"]; ?>' placeholder="" id="email2" name="t2" class="form-control">
                   
                  </div>
                </div>
				
				<div class="form-group ">
                  <label class="col-lg-2 control-label">Area:</label>
                  <div class="col-lg-10">
                    <!--<input type="email" placeholder="" id="email2" class="form-control">-->
					<select placeholder="Select City"  name="t3" class="form-control">
            <option value="">Select Category</option>
                     <?php
					   while($rdcat=$rscat->fetch())
					   {
						   if($rdcat["Area_id"]==$rdp["Area_id"])
						   {
					 ?>
					<option selected value='<?php echo $rdcat["Area_id"]; ?>'><?php echo $rdcat["Area_Name"]; ?></option>
                     <?php
						   }
						   else
						   {
					 ?>
					<option value='<?php echo $rdcat["Area_id"]; ?>'><?php echo $rdcat["Area_Name"]; ?></option>
                     <?php
							   
						   }
					   }
					 ?>
                    </select>   
                   
                 </div>
           </div>
				
				
				<div class="form-group">
                  <label class="col-lg-2 control-label">Phone:</label>
                  <div class="col-lg-10">
				  
                    <input type="text" value='<?php echo $rdp["Phone"]; ?>' placeholder="(123)123-1234" id="phoneNumber" name="t4" class="form-control">
				
                   
                  </div>
                </div>
				
				
	
				<div class="form-group ">
                  <label class="col-lg-2 control-label">Photo:</label>
                  <div class="col-lg-10">
                    <input type="file" name="t5" id="t5" class="form-control">
                  </div>
                  <img id="blah" src='<?php echo $rdp["Photo"]; ?>' width="50" height="50">
                </div>
			
				
				
				
                  <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Update</button>
             </div>
        </div>
             
	  
</form>
	  
	  
 


    
	
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

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

<script>

    $(document).ready(function () {

        var i=0;
        jQuery("input,textarea").on('keypress',function(e){
            //alert();
            if(jQuery(this).val().length < 1){
                if(e.which == 32){
                    //alert(e.which);
                    return false;
                }
            }
            else {
                if(e.which == 32){
                    if(i != 0){
                        return false;
                    }
                    i++;
                }
                else{
                    i=0;
                }
            }
        });

        $('#update_deliveryboy').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                t1: {
                    required: true,
                },
                t2: {
                    required: true,
                },
                t3: {
                    required: true,
                },
                t4: {
                    required: true,
                },
                t5: {
                    required: true,
                    accept: "jpg|jpeg|png|ico|bmp"
                },
            },
            messages: {
                t1: {
                    required: "Please enter delivery boy name",
                },
                t2: {
                    required: "Please enter Address",
                },
                t3: {
                    required: "Please select Area",
                },
                t4: {
                    required: "Please enter Phone number",
                },
                t5: {
                    required: "Please select photo",
                    accept: "Select file must be an image"
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                $('.alert-danger', $('.form-horizontal')).show();
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            onfocusout: function (element) {
                $(element).valid();
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element.closest('.form-control'));
                $("#name-error").css("position", "absolute");
            },
            submitHandler: function (form) {

                $("html, body").animate({scrollTop: 0}, "slow");
                $("#mainContainer").css('opacity', '0.20');
                $("#Loaderaction").css('display', 'inline-block');

                form.submit(); // form validation success, call ajax form submit
            }
        });

    });

</script>