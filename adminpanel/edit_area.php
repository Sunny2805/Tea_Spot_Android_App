
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
  $cn=new PDO("mysql:dbname=tea spot","root","");
  $rscat=$cn->query("select *from area");
  $id=$_GET["x"];
  $rsp=$cn->query("select *From area where Area_id='$id'");
  $rdp=$rsp->fetch();
  
?>
<?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Area</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form" id="update_area" name="update_area" action="update_area.php" method="post" class="form-horizontal style-form">
                <input type="hidden" value='<?php echo $rdp["Area_id"]; ?>' name="id">
				<div class="form-group has-success">
                  <label class="col-lg-2 control-label"> Area Name:</label>
                  <div class="col-lg-10">
                   <input type="text" value='<?php echo $rdp["Area_Name"]; ?>' placeholder="" id="f-name" name="t1" class="form-control">
                   
                  </div>
                </div>
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Update</button>
         </div>
    </div>
 </form>
  		  
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

        $('#update_area').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                t1: {
                    required: true,
                },
            },
            messages: {
                t1: {
                    required: "Please enter Area name",
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











