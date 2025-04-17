<?php
require_once("precedence/classes/cls-newsletter.php");
require_once("precedence/classes/phpmailer.php");

$obj_newsletter = new Newsletter();

if(empty($_GET['email'])){
    header('Location:https://www.towardspackaging.com');
}
 header('Location:https://www.towardspackaging.com/newsletter/thank-you');
exit;
$conn = $obj_newsletter->getConnectionObj();
$newsletter_email = trim($_GET['email'],"/");

    
    
$insert_data['email'] = mysqli_real_escape_string($conn, $newsletter_email);
$insert_data['status'] = "Active";
$insert_data['created_at'] = date("Y-m-d H:i:s");
$insert_data['updated_at'] = date("Y-m-d H:i:s");
$obj_newsletter->insertNewsletter($insert_data, 0);
    
    
    /* Newsletter */
            
    $message = "<html>";
    $message .= "<head>";
    $message .= "<title>Newsletter Subscription - " . SITETITLE . "</title>";
    $message .= "</head>";
    $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
    $message .= '<p>Dear Team,<br><br><b>' . $newsletter_email . '</b> has subscribed for newsletter. Please find the below details</p>
                
				 <table style="border-collapse:collapse;"> 
				 <tr> 
			        <th style="background-color:#5450c1;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px"> Email  </th> 
			        <th style="background-color:#5450c1;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px"> IP Address </th>
				 </tr>
                 <tr>
					<td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $newsletter_email . '  </td>
          
                    <td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . $obj_newsletter->get_client_ip() . ' </td>
                </tr> 
            </table>
            <br/>
            <br/>
				<table style="border-collapse:collapse;">  
				<tr> 
    			<th style="background-color:#001a3f;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">Item </th>
    			<th style="background-color:#001a3f;color:#fff;border:0.3px solid #0000000d;text-align:left;padding:8px">Client Details </th>
    			</tr>
                <tr>   <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    Email  </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px"> ' . $newsletter_email . ' 
                </td>
            </tr>
            <tr>
               <th style="border:0.3px solid #0000000d;text-align:left;padding:8px">
                    IP Address </th><td style="border:0.3px solid #0000000d;text-align:left;padding:8px">' . $obj_newsletter->get_client_ip() . '</b>
                </td>
            </tr> 
            </table>';
    $message .= "</body>";
    $message .= "</html>";
    echo $message;
    $subject = "Newsletter Subscription - " . $newsletter_email . " - " . SITETITLE . "";
    
    $mailsent = sendContactMail($subject, $message);
    
    if ($mailsent) {
        
        
        /*                 * ***Newsletter Subscription User Mail **** */
        $content = "<html>";
        $content .= "<head>";
        $content .= "<title>Newsletter Subscription - " . SITETITLE . "</title>";
        $content .= "</head>";
        $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
        $content .= '<p>Dear ' .$newsletter_email. ',</p>';
        $content .= '<p>Your are successfully subscribed for newsletter.</p>';
        $content .= '<p>Contact Us,<br> Pramod D. </p>';            
        $content .= "</body>";
        $content .= "</html>";
 //echo $content;  
        $subject2 = "Newsletter Subscription - Thank You - " . SITETITLE . "";

        $sent_reciept = sendUserMail($newsletter_email, $subject2, $content);

        /*                 * ***Newsletter Subscription User Mail **** */
        $response["message_code"] = 1;
        $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
        header("Location:" . SITEPATH . "newsletter/thank-you");
        
     
        
   }
    else
    {
        $response["message_code"] = 0;
        $response["message"] = "<strong>Sorry</strong> Error Processing your request. Please try again later";
     
    }
echo json_encode($response);
//die();
?>
