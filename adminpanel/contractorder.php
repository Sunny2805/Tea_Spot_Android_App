
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
		 <?php
$con=new PDO("mysql:dbname=tea spot","root","");

 $rscon=$con->query("select *From `contract` o,user u where o.User_id=u.User_id and o.Contract_id='".$_GET["x"]."'");
 $rdcon=$rscon->fetch();
        ?>



		 
        <h3><i class="fa fa-angle-right"></i> Contract Order</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
            	              <form role="form" id="category" name="category" action="" method="POST"  class="form-horizontal style-form">
                   <input type="hidden" value='<?php echo $_GET["x"]; ?>' name="cid">

  <div class="form-group has-success">
                <label for="cemail" class="control-label col-lg-2">Office Name</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                   <?php echo $rdcon["Office_Name"]; ?> 
                  </div>
                </div>  
            
              <div class="form-group has-success">
                <label for="cemail" class="control-label col-lg-2">Address</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                   <?php echo $rdcon["Address"]; ?> 
                  </div>
                </div>  
                 <div class="form-group has-success">
                <label for="cemail" class="control-label col-lg-2">Contact No</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <?php echo $rdcon["Phone_No"]; ?>
                  </div>
                </div>  
 

              <?php
                 if($rdcon["Status"]=="Active")
                 {
              ?>

            

            
                <div class="form-group has-success">
				<label for="cemail" class="control-label col-lg-2">Transaction Date</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                    <input type="date" style="width:400px"  name="t1" required  class="form-control">
                    
                  </div>
                </div>	
				
				
				
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-theme" type="submit">Submit</button>
             </div>
       </div>
</form>
  <?php
}
  else
  {
  	 echo "";
  }
  ?>




	  
<?php

$con=new PDO("mysql:dbname=tea spot","root","");

?>


<?php
if(isset($_POST["t1"]))
{
$dt=$_POST["t1"];
$cid=$_POST["cid"];


$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into contract_transaction (Contract_id,Transaction_Date) values('$cid','$dt')");
}

?>

<?php
$rs=$con->query("select *From contract_transaction where Contract_id='".$_GET["x"]."'");

?>
			  
<div class="content-panel">
    <table class="table">
        <thead>
            <tr>
                <th>Transaction Date</th>
				<th></th>
                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>
<td><?php echo $rd["Transaction_Date"];?></td>

<td><a href='delete_oc.php?x=<?php echo $rd["Contract_Transaction_id"];?>&y=<?php echo $_GET["x"]; ?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

<td><a href='contractorderdetails.php?x=<?php echo $rd["Contract_Transaction_id"];?>&y=<?php echo $_GET["x"]; ?>' class="btn btn-danger btn-xs">Order Details</a></td>

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

        $('#category').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                t1: {
                    required: true,
                },
                t2: {
                    required: true,
                    accept: "jpg|jpeg|png|ico|bmp"
                },
            },
            messages: {
                t1: {
                    required: "Please enter item name",
                },
                t2: {
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

	
