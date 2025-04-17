<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");
require_once("precedence/classes/phpmailer.php");

$obj_report = new Report();
$obj_lead = new Lead();

$conn = $obj_lead->getConnectionObj();

if($_POST['captchatxt']!=$_POST['capsess'])
{
    $_SESSION['caperr']="Please enter correct security code*";
    echo "<script>window.history.back()</script>";
    exit;
}
// else
// {
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $fname=addslashes(ucfirst(trim($_POST['fname'])));
    $lname=addslashes(ucfirst(trim($_POST['lname'])));
    $email=trim($_POST['email']);
    $country=trim($_POST['country']);
    $phoneno=trim($_POST['phone']);
    $message=addslashes(trim($_POST['message']));
    
    if($fname=="" && empty($fname)){
        $_SESSION['caperr']="Please enter correct data*";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($lname=="" && empty($lname)){
        $_SESSION['caperr']="Please enter correct data*";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($email=="" && empty($email)){
        $_SESSION['caperr']="Please enter correct data*";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($phoneno=="" && empty($phoneno)){
        $_SESSION['caperr']="Please enter correct data*";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($country=="" && empty($country)){
        $_SESSION['caperr']="Please enter correct data*";
        echo "<script>window.history.back()</script>";
        exit;
    }
    
    
    $insert_data['firstname'] = mysqli_real_escape_string($conn, $fname);
    $insert_data['lastname'] = mysqli_real_escape_string($conn, $lname);
    $insert_data['email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['company'] = mysqli_real_escape_string($conn, $_POST['company']);
    $insert_data['designation'] = mysqli_real_escape_string($conn, $_POST['designation']);
    $insert_data['comments'] = mysqli_real_escape_string($conn, $message);
    $insert_data['createddate'] = date("Y-m-d H:i:s");
    $insert_data['modified_date'] = date("Y-m-d H:i:s");
    $insert_data['mailsent'] = "1";
    $insert_data['formname'] = mysqli_real_escape_string($conn, ucfirst($_POST['form_type']));
    $insert_data['IPAddr'] = mysqli_real_escape_string($conn, $ipaddress);
    $insert_id = $obj_lead->insertLead($insert_data, 0);
    
    if ($insert_id) {
        $fields = "*";
        $condition = "`predr_formdetails`.`id` = '" . $insert_id . "'";
        $lead_details = $obj_lead->getLeadDetails($fields, $condition, '', '', 0);
        $lead_detail = end($lead_details);
        
        if (isset($lead_detail) && !empty($lead_detail)) {
            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>".$_POST['form_type']." Request from " . $lead_detail['firstname'] . " – " . $lead_detail['country'] . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:15px;'> <p>Team, get ready to rock! We've got an new client lead to pursue. Let's make it happen together!</p><br>";
            $message .= '<table style="border-collapse:collapse;width: 85%;">  
                            <tr>
                                <th style="background-color: #5b0094; color: #fff;border: 0.7px solid #00000036; text-align: left; padding: 8px;">Item List</td>
                                <th style="background-color: #5b0094; color: #fff;border: 0.7px solid #00000036; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">'.$_POST['form_type'].' Request</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Name</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['firstname'] .' '. $lead_detail['lastname']. '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Phone Number</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['phone'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Email Id</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['email'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['country'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Company</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['company'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Designation</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['designation'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">Comment</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . nl2br($lead_detail['comments']) . '</td>
                            </tr>  
                            <tr>
                                <th style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">IP Address</th>
                                <td style="border: 0.8px solid #00000036; text-align: left; padding: 8px;">' . $lead_detail['IPAddr'] . '</td>
                            </tr>
                        </table>
                        ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = $_POST['form_type']." from " . $lead_detail['firstname'] . "";

            $mailsent = sendReportMail($subject, $message);
            
            if ($mailsent) {

                /*                 * *** User Mail **** */
                // $content = "<html>";
                // $content .= "<head>";
                // $content .= "<title>" . SITETITLE . " Received Your ".$_POST['form_type']." Request</title>";
                // $content .= "</head>";
                // $content .= "<body  style='font-size:16px;'>";
                // $content .= '<p>Dear ' .$_POST['fname'].',</p>';
                // $content .= "<p>I hope this message finds you well.</p>
                //              <p>I am Pramod Dige, I delighted to take this opportunity to introduce myself as the CEO of Precedence Statistics. It is a privilege to be at the helm of this incredible organization, and I look forward to working closely with you.</p>
                //              <p>Our team is already working on your request, and we will get back to you with a comprehensive response as soon as possible. We believe that our tool have the potential to address your needs effectively, and we are eager to demonstrate the value they can bring to your business.</p>
                //              <p>If you have any immediate questions or require further information, please don't hesitate to reach out to us at <strong> pramod@precedencestatistics.com </strong>OR <strong> +1 650 460 3308 </strong></p>
                //              <p>Best regards,<br> Pramod Dige<br>" . SITETITLE . "</p>";
                // $content .= "</body>";
                // $content .= "</html>";

                // $subject2 = SITETITLE . " - Received Your ".$_POST['form_type'].""; 

                // $sent_reciept = sendUserMail($lead_detail['email'], $subject2, $content);
                
                $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
                $response["message_code"] = 1;
               
                if($_POST['form_type']=="Request Subscription"){        
                header("Location:subscription-thanks");  
                }

            }
            else
            {
                echo "Something went wrong, Please try again..";
            }
                /*                 * *** User Mail **** */
        
        }
    //}
}

?>