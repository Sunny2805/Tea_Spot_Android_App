<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php include("header.php");?>
    
	<script>
	     function check()
		  {
			    var np=document.f1.t2.value;
				var cp=document.f1.t3.value;
				if(np==cp)
				{
					return true;
				}
				else{
					document.getElementById("d1").innerHTML="<font color='red'>Not Match Confirm Password</font>";
					return false;
				}
		  }
	
		  
		  
		  
	</script> 
    <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i> Change Password</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" id="changepass" name="changepass" action="updatepassword.php" name="f1" onsubmit="return check();"  method="post" class="form-horizontal style-form" >
                <div class="form-group has-success">
                  <label class="col-lg-2 control-label">Old Password:</label>
                  <div class="col-lg-10">
                   
				   <input type="password" name="t1" placeholder="" style="width:500px" id="Old Password" class="form-control" inputmode="numeric" minlength="4"
                              maxlength="8" size="8" >
				   
				   
                    
                  </div>
                </div>
               <div class="form-group has-success">
                  <label class="col-lg-2 control-label" >New Password:</label>
                  <div class="col-lg-10">
                    <input type="password"  name="t2" style="width:500px" placeholder="" id="npass" class="form-control" inputmode="numeric" minlength="4"
                              maxlength="8" size="8" >
                    </div>
                  </div>
				  <div class="form-group has-success">
                  <label class="col-lg-2 control-label" inputmode="numeric" minlength="4"
                              maxlength="8" size="8">Confirm Password:</label>
                  <div class="col-lg-10">
                    <input type="password"   name="t3" style="width:500px" placeholder="" id="cpass" class="form-control" inputmode="numeric" minlength="4"
                              maxlength="8" size="8" >
                     <div id="d1"></div>
                  </div>
                </div>
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit" >Submit</button>
                  </div>
                </div>
             
	  
	  </form>
	      <br>
		    <?php
			 if(isset($_GET["x"]))
			 {
				   if($_GET["x"]==1)
				   {
					    ?>
						 Your Password Chanaged Successfully.
						<?php
				   }
				   else
				   {
					    ?>
						 <font color="red">Invalid Old Password.</font>
						<?php
				  
				   }
			 }
			 
			?>
            </div>
   
              </form>
           
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

        $('#changepass').validate({
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
            },
            messages: {
                t1: {
                    required: "Please enter old password",
                },
                t2: {
                    required: "Please enter new password",
                },
                t3: {
                    required: "Please enter confirm password",
                },
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