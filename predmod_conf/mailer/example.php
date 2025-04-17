<?php require_once('PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = '192.185.129.32';
$mail->SMTPAuth = true; 
$mail->Username = 'webmaster@coherentmarketinsights.com';
$mail->Password = 'TeKMyTT+&h,z';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('webmaster@coherentmarketinsights.com', 'Mailer');
$mail->addAddress('sales@coherentmarketinsights.com', 'Joe User');
$mail->addAddress('ni3pathade@gmail.com');
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->isHTML(true);

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}