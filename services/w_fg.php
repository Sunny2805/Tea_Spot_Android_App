<?php
 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

 $e=$_REQUEST["email"];
 
 
$con=new PDO("mysql:dbname=tea spot","root","");
$rs=$con->query("select *From user where Email_id='$e'");
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
    $mail->setFrom('mb8000805119@gmail.com', 'Mayur');
    $mail->addAddress($e);     // Add a recipient
    $mail->addReplyTo('mb8000805119@gmail.com', 'no replay');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'YOUR password Tea Spot Password';
    $mail->Body    = "Your Tea Spot Password is ".$rd["Password"];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
$arr=Array("msg"=> "Your password sent to your register emailid.");
} catch (Exception $e) {
$arr=Array("msg"=> "Mail Error.");
}    





}
else
{
$arr=Array("msg"=> "Invalid Emailid.");
}
echo json_encode($arr);
?>