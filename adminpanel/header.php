<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Tea Spot</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

 <!--Data Tables -->
  <link href="assets1/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets1/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
 

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>TEA<span>SPOT<span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">


        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="login.php">Logout</a></li>
        </ul>
        <span class="nav pull-right top-menu" style="position: relative;
    margin-top: 15px;
    margin-right: 50px;
    font-size: 25px;
"><a href="order.php"><i class="fa fa-bell-o" id="noti">
</i></a></span>

        
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/sannyp.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">Tea Spot</h5>
          <li class="mt">
            <a href="welcome.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
            <a  href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>Forms</span>
              </a>
            <ul class="sub">
               <li><a href="item.php">Item</a></li>
               <li><a href="category.php">Category</a></li>
			 			 
		      <li><a href="deliveryboy.php">Delivery Boy</a></li>
		      <li><a href="area.php">Area</a></li>
            
			</ul>
          </li>
		 
 
 <li class="sub-menu">
            <a href="order.php">
              <i class="fa fa-shopping-bag"></i>
              <span>Order</span>
              </a>
          </li>
 
 <li class="sub-menu">
            <a href="viewcontract.php">
              <i class="fa fa-book"></i>
              <span>Contract</span>
              </a>
          </li>
 
 

 <li class="sub-menu">
            <a href="feedback.php">
              <i class="fa fa-file-o"></i>
              <span>Feedback</span>
              </a>
          </li>
         		 
 
		  
		  
  <li class="sub-menu">
            <a  href="javascript:;">
              <i class="fa fa-user"></i>
              <span>Setting</span>
              </a>
            <ul class="sub">
  
			  <li><a href="changepassword.php">ChangePassword</a></li>
                       
			<li class="active"><a href="admin.php">Manage Admin</a></li>
			  
			</ul>
          </li>
        		  


  <li class="sub-menu">
            <a  href="javascript:;">
              <i class="fa fa-bar-chart"></i>
              <span>Reports</span>
              </a>
            <ul class="sub">
  <li><a href="report1.php">All Delivery Boy Report</a></li>
 
  <li><a href="report2.php">All User Report</a></li>

              
			  <li><a href="report3.php">Area Wise User Report</a></li>
                       
			<li ><a href="report4.php">Date Wise Register User Report</a></li>
			<li ><a href="report5.php">Date Wise Order Report</a></li>
			<li ><a href="report6.php">Category Wise Item Report</a></li>
			<li ><a href="report7.php">Area Wise Contract Report</a></li>
			<li ><a href="report8.php">Contract & Date Wise Order Report</a></li>
			<li ><a href="report9.php">Cancelled Contract Report</a></li>
			  

			</ul>
          </li>

      
	  </div>
    </aside>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php
$con=new PDO("mysql:dbname=tea spot","root","");



$sql = "SELECT count(*) FROM `order`"; 
$result = $con->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
?>
      <input type="hidden" name="current_order" id="current_order" value="<?=$number_of_rows?>">
    <script type="text/javascript">
      function playSound()
{
    var audio = new Audio('http://www.rangde.org/static/bell-ring-01.mp3');
    audio.play();
}
function doAjax() {
      $.ajax({
            method: "POST",
            url: "server.php",
            
      }).done(function( msg ) {
          if($('#current_order').val() != msg)
          {          playSound()
                    alert('new order');
                $('#current_order').val(msg);
                $('#noti').css('color','orange');
          }

            });
  }
  setInterval(doAjax,playSound, 10000);
    </script>

