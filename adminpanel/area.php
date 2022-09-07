
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Area</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form" id="area" name="area" action="" method="post" class="form-horizontal style-form">
                <div class="form-group">
                  <label class="col-lg-2 control-label"> Area Name:</label>
                  <div class="col-lg-10">
                   <input type="text" placeholder="" id="f-name" name="t1" class="form-control">
                   
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

$con=new PDO("mysql:dbname=tea spot","root","");

?>

<?php
if(isset($_POST["t1"]))
{
$area=$_POST["t1"];

$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into area(Area_Name)
values('$area')");
//echo "Insert data";
	}
?>

 <!----------------------------DISPLAY**DATA------------------------->

<?php


$rs=$con->query("select *From area");

?>
			  
			  <div class="content-panel">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Area Name</th>
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

<td><?php echo $rd["Area_id"];?></td>
<td><?php echo $rd["Area_Name"];?></td>
<!--<td><a href='#'>Delete</a></td>
<td><a href='#'>Edit</a></td>-->
<td><a href='edit_area.php?x=<?php echo $rd["Area_id"];?>' class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
<td><a href='delete_area.php?x=<?php echo $rd["Area_id"];?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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

        $('#area').validate({
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




