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
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
</head>
<body>
    <form class="form-login" method="POST">
    <h2 class="form-login-heading">Forgot Password</h2>
            
                <div class="login-wrap">
    <input class="form-control" type="text" name="email" placeholder="email" autocomplete="off">
</br>
    <input class="btn btn-theme btn-block" type="submit" name="submit" value="Reset Email">
    </div>
</form>
    
    <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/bg.jpg", {
      speed: 500
    });
  </script>
</body>
</html>





<?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//$e=$_REQUEST["email"];
 if(isset($_POST["email"])){
$emailto=$_POST["email"];
 {
   

 
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *From admin where Emailid='$emailto'");
}

if($rd=$rs->fetch())
{



$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'mb8000805119@gmail.com';                     // SMTP username
    $mail->Password   = '1om2sai3ram';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('mb8000805119@gmail.com', 'Tea Spot');
    $mail->addAddress($emailto);     // Add a recipient
    $mail->addReplyTo('mb8000805119@gmail.com', 'no replay');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'YOUR Tea Spot Admin Password';
    $mail->Body    = "Your Tea Spot Password is ".$rd["Password"];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
$arr=Array("Your password sent to your register emailid.");
} catch (Exception $emailto) {
$arr=Array("Mail Error.");
}    

}
else
{
$arr=Array("Invalid Emailid.");
}

echo json_encode($arr);
}
?>
<!--<form method="POST">
    <input class="btn btn-theme btn-block" type="text" name="email" placeholder="email" autocomplete="off">
</br>
    <input class="btn btn-theme btn-block" type="submit" name="submit" value="reset email">
    
</form> -->






