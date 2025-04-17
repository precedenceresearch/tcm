<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");
require_once("precedence/classes/phpmailer.php");

$obj_report = new Report();
$obj_lead = new Lead();

$conn = $obj_lead->getConnectionObj();

if($_POST['captchatxt']!=$_POST['capsess'])
{
    $_SESSION['caperr']="Please enter correct security code!";
    echo "<script>window.history.back()</script>";
}
else
{
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $name=addslashes(ucfirst(trim($_POST['fname'])));
    $email=trim($_POST['email']);
    $countrywcode=explode("*",$_POST['country']);
    $country=$countrywcode[1];
    $phoneno="+".$countrywcode[0]." ".trim($_POST['phone_no']);
    $message=addslashes(trim($_POST['message']));
    
    if($name=="" && empty($name)){
        $_SESSION['caperr']="Please enter correct data!";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($email=="" && empty($email)){
        $_SESSION['caperr']="Please enter correct data!";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($countrywcode=="" && empty($countrywcode)){
        $_SESSION['caperr']="Please enter correct data!";
        echo "<script>window.history.back()</script>";
        exit;
    }
    if($phoneno=="" && empty($phoneno)){
        $_SESSION['caperr']="Please enter correct data!";
        echo "<script>window.history.back()</script>";
        exit;
    }
    
    
    $insert_data['firstname'] = mysqli_real_escape_string($conn, $name);
    $insert_data['email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['comments'] = mysqli_real_escape_string($conn, $message);
    $insert_data['company'] = mysqli_real_escape_string($conn, trim($_POST['company']));
    $insert_data['designation'] = mysqli_real_escape_string($conn, trim($_POST['designation']));
    $insert_data['createddate'] = date("Y-m-d H:i:s");
    $insert_data['modified_date'] = date("Y-m-d H:i:s");
    $insert_data['mailsent'] = "1";
    $insert_data['formname'] = mysqli_real_escape_string($conn, $_POST['form_type_table']);
    $insert_data['IPAddr'] = mysqli_real_escape_string($conn, $ipaddress);
    $insert_id = $obj_lead->insertLead($insert_data, 0);
    
    if ($insert_id) {
        $fields = "*";
        $condition = "`predr_formdetails`.`id` = '" . $insert_id . "'";
        $lead_details = $obj_lead->getLeadDetails($fields, $condition, '', '', 0);
        $lead_detail = end($lead_details);
        
        /******************API Code For CRM*****************/
		$slug="";
		$prdurl_crm="https://www.precedenceresearch.com/";
		$url=$prdurl_crm.'precedencelogin/crm/apii.php';
        $ch = curl_init($url);
        
		$fullname=explode(" ",$lead_detail['firstname']);
        $lead_source = "Report-Page";
        $lead_source_category = "IB";
        $fname = ucfirst(trim($fullname[0]));
        $lname = ucfirst(trim($fullname[1]));
        $email = trim($lead_detail['email']);
        $phone = trim($lead_detail['phone']);
        $country = trim($lead_detail['country']);
        $job_title = trim($lead_detail['designation']);
        $company = trim($lead_detail['company']);
        $comment = trim($lead_detail['comments']);
        $website = SITETITLE;
        $request_from_page = trim($lead_detail['formname']);
        $report_url="";
        $region="";
        $data = array(
          "lead_source" => $lead_source,
          "lead_source_category" => $lead_source_category,
          "fname" => $fname,
          "lname" => $lname,
          "email" => $email,
          "phone" => $phone,
          "country" => $country,
          "region" => $region,
          "job_title" => $job_title,
          "company" => $company,
          "comment" => $comment,
          "report_url" => $report_url,
          "website" => $website,
          "request_from_page" => $request_from_page
      );
    
        $dataEncoded = json_encode($data);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncoded);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Control-Allow-Origin: *'));
        $result = curl_exec($ch);
		/******************End API Code For CRM*****************/
        
        
        if (isset($lead_detail) && !empty($lead_detail)) {
            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>".$_POST['form_type']." Request from " . $lead_detail['firstname'] . " – " . $lead_detail['country'] . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= '<p>Dear Team,<br><br>Contact us request has been initiated. Please find the below details</p>';
            $message .= '<table style="border-collapse:collapse;">  
                            <tr>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Item</td>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">'.$_POST['form_type'].' Request</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Name</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['firstname'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Phone Number</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['phone'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email Id</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['email'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['country'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Company</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['company'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Designation</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['designation'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Comment</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . nl2br($lead_detail['comments']) . '</td>
                            </tr>  
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">IP Address</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['IPAddr'] . '</td>
                            </tr>
                        </table>
                        ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = $_POST['form_type']." - " . $lead_detail['firstname'] . " - " . $lead_detail['country'] . "";

            $mailsent = sendReportMail($subject, $message);
            if ($mailsent) {
                    
               
                /*                 * *** User Mail **** */
                $content = "<html>";
                $content .= "<head>";
                $content .= "<title>" . SITETITLE . " Received Your ".$_POST['form_type']." Request</title>";
                $content .= "</head>";
                $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
                $content .= '<p>Dear ' .$_POST['fname'].',</p>';
                $content .= '<p>We have done some extensive, granular level research and have a strong Analyst base that can handle any Research queries around this topic.</p>
                             <p>Let us know a convenient time for a quick call to better understand and cater to your requirement most appropriately.</p>
                             <p>You can also email me about specific aspects that you are looking for or contact us at <strong>'.SITEEMAIL.'</strong> OR <strong>+1 (407) 768-2028</strong>.</p>
                             <p>Looking forward to hearing from you.</p>
                             <p>Warm Regards,<br> Pramod Dige<br>' . SITETITLE . '</p>';
                $content .= "</body>";
                $content .= "</html>";

                $subject2 = SITETITLE . " Received Your ".$_POST['form_type']." Request";

                $sent_reciept = sendUserMail($lead_detail['email'], $subject2, $content);
                
                $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
                $response["message_code"] = 1;
               
                header("Location:".SITEPATH."contact-thank-you"); 
                
                
            }
            else
            {
                $response["message"] = "<strong>Congratulations</strong> Your Request not get recieved";
                $response["message_code"] = 0;
                $response["report_id"] = trim($_POST['report_id']);
                 header("Location:".SITEPATH."404"); 
            }
                /*                 * *** User Mail **** */
              
        }
    }
}

?>