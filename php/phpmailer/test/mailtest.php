<?php
require("../class.phpmailer.php");

$mail = new PHPMailer();

//$mail->IsSMTP();                                      // set mailer to use SMTP
//$mail->Host = "smtp1.example.com;smtp2.example.com";  // specify main and backup server
//$mail->SMTPAuth = true;     // turn on SMTP authentication
//$mail->Username = "jswan";  // SMTP username
//$mail->Password = "secret"; // SMTP password

$mail->From = "from@example.com";
$mail->FromName = "Mailer";
$mail->AddAddress("tim.maggart@docustar.com", "Tim Adams");
$mail->AddAddress("digital_ferris@mac.com");                  // name is optional
$mail->AddReplyTo("tim.maggart@docustar.com", "Information");

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
$mail->IsHTML(true);                                  // set email format to HTML

$mail->Subject = "Here is the subject";
$mail->Body    = "This is the HTML message body <b>in bold!</b>";
$mail->Body    .= "<TABLE border='1' width='100%'><TR><TD>testing </TD></TR></TABLE>";

$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
?>