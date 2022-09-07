
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php include("header.php");?>
    <section id="main-content">
      <section class="wrapper">
	     
		 <?php
$con=new PDO("mysql:dbname=tea spot","root","");

 $rscon=$con->query("select *From `contract` o,user u where o.User_id=u.User_id and o.Contract_id='".$_GET["y"]."'");
 $rdcon=$rscon->fetch();

  $rstr=$con->query("select *from contract_transaction where Contract_Transaction_id='".$_GET["x"]."'");
  $rdtr=$rstr->fetch();

  $rsitem=$con->query("select *From item  ");
$rscat=$con->query("select *From category");


        ?>



		 
        <h3><i class="fa fa-angle-right"></i> Contract Order Details</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
           <!-- <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>-->
            <div class="form-panel">
              <form role="form" id="category" name="category" action="" method="POST"  class="form-horizontal style-form">
                   <input type="hidden" value='<?php echo $_GET["x"]; ?>' name="ctid">
 <input type="hidden" value='<?php echo $_GET["y"]; ?>' name="cid">


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
				<label for="cemail" class="control-label col-lg-2">Transaction Date</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                       <?php echo $rdtr["Transaction_Date"]; ?>                  
                  </div>
                </div>	
				
				
           <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Order Time</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                                 <select  style="width:400px"  name="t1"   class="form-control">
                                  <option value="Morning">Morning</option>
                                  <option value="Noon">Noon</option>
                                  <option value="Evening">Evening</option>
                                  <option value="Night">Night</option>                                  
                                </select>
                         
                  </div>
                </div>  

        

           <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Category</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                                 <select  style="width:400px"  name="t2"   class="form-control">
                                  <?php
                                     while($rdcat=$rscat->fetch())
                                     {

                                  ?>
                                  <option value="<?php echo $rdcat["Category_id"]; ?>"><?php echo $rdcat["Name"] ?></option>
                                  <?php
                                      }
                                  ?>
                                </select>
                         
                  </div>
                </div>  



           <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Item</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                                 <select  style="width:400px"  name="t3"   class="form-control">
                                 <?php
                                     while($rditem=$rsitem->fetch())
                                     {

                                  ?>
                                  <option value="<?php echo $rditem["Item_id"]; ?>"><?php echo $rditem["Item_Name"] ?></option>
                                  <?php
                                      }
                                  ?> </select>
                         
                  </div>
                </div>  
                
                

           <div class="form-group has-success">
        <label for="cemail" class="control-label col-lg-2">Qunatity</label>
                  <!--<label class="col-lg-2 control-label"> Category Name:</label>-->
                  <div class="col-lg-10">
                                 <input type="text"  style="width:400px"  name="t4"   class="form-control">
                                 
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
$t=$_POST["t1"];
$itid=$_POST["t3"];
$q=$_POST["t4"];

$cid=$_POST["cid"];
$ctid=$_POST["ctid"];


$con=new PDO("mysql:dbname=tea spot","root","");
$con->query("insert into item_order (Contract_Transaction_id,Item_id,Qty,ordertime) 
  values('$ctid','$itid','$q','$t')");
}

?>

<?php
$rs=$con->query("select *From item_order t,item i  where t.Item_id=i.Item_id and t.Contract_Transaction_id='".$_GET["x"]."'");

?>
			  
<div class="content-panel">
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Order Time</th>
                
				<th></th>
                 </tr>
        </thead>
     <tbody>
<?php
while($rd=$rs->fetch())
{
	?>
	
<tr>
<td><?php echo $rd["Item_Name"];?></td>
<td><?php echo $rd["Price"];?></td>
<td><?php echo $rd["Qty"];?></td>
<td><?php echo $rd["ordertime"];?></td>



<td><a href='delete_ocdetails.php?z=<?php echo $rd["Item_Order_id"];?>&x=<?php echo $_GET["x"]; ?>&y=<?php echo $_GET["y"];  ?>' class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>


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

	
