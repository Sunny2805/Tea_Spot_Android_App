
<?php /*?>
<?php
  $cn=new PDO("mysql:dbname=tea spot","root","");
  $rscat=$cn->query("select *from admin");
  $id=$_GET["x"];
  $rsp=$cn->query("select *From admin where admin_id='$id'");
  $rdp=$rsp->fetch();
  
?>
 <section id="main-content">
      <section class="wrapper">
	  
        <h3><i class="fa fa-angle-right"></i>Admin Table</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" action="" method="post" enctype="multipart/form-data" class="form-horizontal style-form">
                <div class="form-group has-success">
                  <label class="col-lg-2 control-label">Name:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="" id="f-name" name="t1" class="form-control">
                    
                  </div>
                </div>
               
                <div class="form-group has-warning">
                  <label class="col-lg-2 control-label">Password:</label>
                  <div class="col-lg-10">
                    <input type="text" placeholder="" id="email2" name="t2" class="form-control">
                   
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
		$password=$_POST["t2"];
		$con=new PDO("mysql:dbname=tea spot","root","");
		$con->query("insert into admin(Name,Password) values('$name','$password')");
	  }
	  ?>
	  <?php
$rs=$con->query("select *from admin");
	  
	  ?>
	  
	  <div class="content-panel">
    <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name:</th>
					<th>Password:</th>
					
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
<td><?php echo $rd["Admin_id"];?></td>
<td><?php echo $rd["Name"];?></td>
<td><?php echo $rd["Password"];?></td>


<!--<td><a href='#'>Delete</a></td>
<td><a href='#'>Edit</a></td>-->
<td><a href='admin_edit.php?x=<?php echo $rd["Admin_id"];?>' class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a></td>
<td><a href='admin_delete.php?x=<?php echo $rd["Admin_id"];?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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
<?php */?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
  $cn=new PDO("mysql:dbname=tea spot","root","");
  $rscat=$cn->query("select *from admin");
  $id=$_GET["x"];
  $rsp=$cn->query("select *From admin where Admin_id='$id'");
  $rdp=$rsp->fetch();
  
?>
<?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Admin</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
          
            <div class="form-panel">
              <form role="form" id="update_admin" name="update_admin" action="update_admin.php" method="post" class="form-horizontal style-form">
                <input type="hidden" value='<?php echo $rdp["Admin_id"]; ?>' name="id">
				<div class="form-group">
                  <label class="col-lg-2 control-label">Name:</label>
                  <div class="col-lg-10">
                   <input type="text" value='<?php echo $rdp["Name"]; ?>' placeholder="" id="name" name="t1" class="form-control">
                   
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-lg-2 control-label">Emailid:</label>
                  <div class="col-lg-10">
                   <input type="text" value='<?php echo $rdp["Emailid"]; ?>' placeholder="" id="email" name="t2" class="form-control">
                   
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-lg-2 control-label">Password:</label>
                  <div class="col-lg-10">
                   <input type="text" value='<?php echo $rdp["Password"]; ?>' placeholder="" id="password" name="t3" class="form-control">
                   
                  </div>
                </div>
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Update</button>
         </div>
    </div>
 </form>
  <!----------------------------INSERT**DATA------------------------>			  
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

        $('#update_admin').validate({
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
                    required: "Please enter Admin name",
                },
                t2: {
                    required: "Please enter Emailid",
                },
                t3: {
                    required: "Please Password",
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








