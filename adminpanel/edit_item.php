
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
$con=new PDO("mysql:dbname=tea spot","root","");

$id=$_GET["x"];
$rsp=$con->query("select *from item where Item_id='$id'");
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
$rsa=$con->query("select *from category");
?>


<?php include("header.php");?>
    
    <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i> Item</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" id="update_item" name="update_item" action="update_item.php" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
			  <input type="hidden" value='<?php echo $rdp["Item_id"]; ?>' name="id">
                <div class="form-group">
                  <label class="col-lg-2 control-label"> Item Name:</label>
                  <div class="col-lg-10">
                    <input type="text" value='<?php echo $rdp["Item_Name"]; ?>' placeholder="Enter The Item Name" id="item_name" name="t1" class="form-control">
                    
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="col-lg-2 control-label">Price:</label>
                  <div class="col-lg-10"> 
                    <input type="text" value='<?php echo $rdp["Price"]; ?>'placeholder="Enter The Price" id="item_Price" name="t2" class="form-control">
                   
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-2 control-label">Category_Id:</label>
                  <div class="col-lg-10">
					<select placeholder="Select Category" id="category"  name="t3" class="form-control">
             <option value="">Select Category</option>
                     <?php
					   while($rda=$rsa->fetch())
					   {
					 ?>
					<option value='<?php echo $rda["Category_id"]; ?>'><?php echo $rda["Name"]; ?></option>
                     <?php
					   }
					 ?>
                    </select>     
                   
                 </div>
           </div>
				
				
				
				
				
				
				
				<div class="form-group ">
                  <label class="col-lg-2 control-label">Description:</label>
                  <div class="col-lg-10">
                    <textarea  rows="5" cols="50"  placeholder="Enter The Description" id="item_Description" name="t4" class="form-control"><?php echo $rdp["Description"]; ?></textarea>
                   </div>
                </div>

        <div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Photo:</label>
                  <div class="col-lg-10">
                    <input type="file" id="photo" name="t5" id="t5" class="form-control">
                  </div>
                   <img id="blah" src='<?php echo $rdp["Photo"]; ?>' width="50" height="50">
                </div>
        
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">update</button>
                  </div>
                </div>
             
	  
	    </form>

			  

   
</tbody>
              </table>
            </div>
		
   
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

        $('#update_item').validate({
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
                    required: "Please enter item name",
                },
                t2: {
                    required: "Please enter price",
                },
                t3: {
                    required: "Please select category",
                },
                t4: {
                    required: "Please enter description",
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
    