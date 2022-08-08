<?php

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = '';          					   // SMTP username 
$mail->Password = ''; 

$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('', ''); 
$mail->addReplyTo('', '');
$mail->addAddress();   // Add a recipient 
//$mail->addBCC('.com'); //For CC and BCC

$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Password Recovery</h1>';

$mail->Subject = '';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	echo "Mail sent";
}?>