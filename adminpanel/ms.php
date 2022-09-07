<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$con=mysqli_connect("localhost","root","","rp");
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';
if(isset($_POST["email"])){
$emailto=$_POST["email"];
$code =uniqid(true);
$query =mysqli_query($con,"INSERT INTO rp(code,email) VALUES('$code','$emailto')");
if (!$query) {
   exit("error");
}
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'mb8000805119@gmail.com';                     // SMTP username
    $mail->Password   = '1om2sai3ram';                               // SMTP password
    $mail->SMTPSecure = 'tlS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('mb8000805119@gmail.com', 'Mayur');
    $mail->addAddress($emailto);     // Add a recipient
    $mail->addReplyTo('mb8000805119@gmail.com', 'no replay');
    // Content
    $url ="http://".$SERVER["HTTP_HOST"].dirname($SERVER["PHP_SELF"])."localhost/rp/rf.php?code=$code";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'YOUR password reset link is';
    $mail->Body    = "<h1> you requested a password reset </h1>
                    click <a href='localhost/rp/rf.php'> this link</a> to do so";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'reset  password link has been sent to your email';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error:' ,$mail->ErrorInfo;
}    
exit();
}

?>
<form method="POST">
    <input type="text" name="email" placeholder="email" autocomplete="off">
</br>
    <input type="submit" name="submit" value="reset email">
    
</form>
