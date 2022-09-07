

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>

<script>
  function loadpayment()
  {

   var cid=document.f1.cid.value;
   var y=document.f1.t1.value;
   var m=document.f1.t2.value;

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("pid").innerHTML = this.responseText;
                document.f1.payment.value=this.responseText;
            }
        };
        xmlhttp.open("GET", "gettotal.php?y=" + y+"&m="+m+"&cid="+cid, true);
        xmlhttp.send();
  }
</script>

    <section id="main-content">
      <section class="wrapper">
       
     <?php
$con=new PDO("mysql:dbname=tea spot","root","");

 $rscon=$con->query("select *From `contract` o,user u where o.User_id=u.User_id and o.Contract_id='".$_GET["x"]."'");
 $rdcon=$rscon->fetch();
        ?>



     
        <h3><i class="fa fa-angle-right"></i> Payment</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
                            <form role="form" id="category" name="f1" name="category" action="" method="POST"  class="form-horizontal style-form">
                   <input type="hidden" value='<?php echo $_GET["x"]; ?>' name="cid">
<input type="hidden"  name="payment">


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
            


            
                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Year</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">

                    <select style="width:100px"  name="t1" required  class="form-control">
                     <option value="2020">2020</option>
                     <option value="2021">2021</option>
                     <option value="2022">2022</option>
                     
                    </select>
                      <br>
                 
                  </div>
                </div>  
        
        
         <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Month</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">

                    <select style="width:100px" onchange="loadpayment();"  name="t2" required  class="form-control">
                     <option value="January">01</option>
                     <option value="February">02</option>
                     <option value="March">03</option>
                     <option value="April">04</option>
                     <option value="May">05</option>
                     <option value="June">06</option>
                     <option value="July">07</option>
                     <option value="August">08</option>
                     <option value="September">09</option>
                     <option value="October">10</option>
                     <option value="November">11</option>
                     <option value="December">12</option>
                     
                    </select>
                 
                  </div>
                </div>  
        



                <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Total Payment</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">

                   <div id="pid"></div> Rs.
                      <br>
                 
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
$m=$_POST["t1"];
$y=$_POST["t2"];
$str=$m."-".$y;
$cid=$_POST["cid"];
$payment=$_POST["payment"];
$dt=date("Y-m-d");
$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into contract_payment (Contract_id,Month,Payment,Paymentdate) values('$cid','$str','$payment','$dt')");
}

?>

<?php
$rs=$con->query("select *From contract_payment where Contract_id='".$_GET["x"]."'");

?>
        
<div class="content-panel">
    <table class="table">
        <thead>
            <tr>
                <th>Month</th>
        <th>Payment</th>
                   <th>Paymentdate</th>
                     
        
        <th></th>

                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
  ?>
  
<tr>
<td><?php echo $rd["Month"];?></td>
<td><?php echo $rd["Payment"];?></td>
<td><?php echo $rd["Paymentdate"];?></td>


<td><a href='delete_payment.php?x=<?php echo $rd["Contract_Payment_id"];?>&y=<?php echo $_GET["x"]; ?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>

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
