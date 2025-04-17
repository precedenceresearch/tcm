<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/towardspackaging/public_html/lib/PHPMailer/src/Exception.php';
require '/home/towardspackaging/public_html/lib/PHPMailer/src/PHPMailer.php';
require '/home/towardspackaging/public_html/lib/PHPMailer/src/SMTP.php';


function sendReportMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "XmsLjuS;&!xl";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "TP | Sales";
    $mail->AddAddress("contactus@towardspackaging.com");
    
    #BCC Email Address
    $mail->AddBCC("leadspackaging@precedenceresearch.com");
    
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}

function sendReportMailRegion($subject, $message, $region) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "XmsLjuS;&!xl";
    /* * * SMTP * * */

     //$mail->From = "sales@alltheresearch.com";
    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "TP | Sales";
    $mail->AddAddress("contactus@towardspackaging.com");
    
    #BCC Email Address
       if($region=="North America" || $region=="South / Latin America"){
            $mail->AddBCC("piyush.pawar@precedenceresearch.com");
       }elseif($region=="Middle East" || $region=="Europe"){
        $mail->AddBCC("sandeep.shinde@precedenceresearch.com");
       }elseif($region=="Asia Pacific"){
        $mail->AddBCC("ankita.dey@precedenceresearch.com");
        $mail->AddBCC("prasad.patil@precedenceresearch.com");
       }else{
        $mail->AddBCC("sandeep.shinde@precedenceresearch.com");
       }
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}

function sendUserMail($to, $subject, $message) {
   $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "XmsLjuS;&!xl";
    /* * * SMTP * * */

    //$mail->From = "sales@alltheresearch.com";
    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "Towards Packaging";
     $mail->AddAddress("$to");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
      //  echo "Mailer Error: " . $mail->ErrorInfo;
        die();
        return false;
    }

    return true;
}

function sendContactMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "9B9a5%d#uED!";
    /* * * SMTP * * */

    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "Contact Us";
    $mail->AddAddress("contactus@towardspackaging.com");
   
    #BCC Email Address
    
    $mail->AddBCC("leadspackaging@precedenceresearch.com");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function SendSupportMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "9B9a5%d#uED!";
    /* * * SMTP * * */

    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "Towards Packaging";
    $mail->AddAddress("contactus@towardspackaging.com");
    
    $mail->AddBCC("leadspackaging@precedenceresearch.com");

    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

function sendLeadMail($subject, $message) {
    $mail = new PHPMailer();
    /* * * SMTP * * */
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "towardspackaging.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
     $mail->Username = "noreply@towardspackaging.com";
    $mail->Password = "9B9a5%d#uED!";
    /* * * SMTP * * */

    $mail->From = "sales@towardspackaging.com";
    $mail->FromName = "Towards Packaging";
    $mail->AddAddress("contactus@towardspackaging.com");
    
    $mail->AddBCC("leadspackaging@precedenceresearch.com");
       
//$mail->AddBCC("akkhijadhav22@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $message;

    if (!$mail->Send()) {
       // echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }

    return true;
}

?>
