<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");
require_once("precedence/classes/phpmailer.php");

$obj_report = new Report();
$obj_lead = new Lead();

$conn = $obj_lead->getConnectionObj();

$email=trim($_POST['email']);
    
if($email=="" || empty($email) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location:".SITEPATH."contact-thank-you"); 
    exit;
}
if($email=="julian@oc3d.io"){
    header("Location:".SITEPATH."contact-thank-you"); 
    exit;
}


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
   
    $client_interest=$_POST['requirement_type'];
   
    $message=addslashes(trim($_POST['message']));
    $category=$_POST['category'];
    if(isset($_POST['budget_1'])){
        $budget = $_POST['budget_1'];
    }else{
        $budget = "00";
    }

    $insert_data['firstname'] = mysqli_real_escape_string($conn, $name);
    $insert_data['email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['company'] = mysqli_real_escape_string($conn, trim($_POST['company']));
    $insert_data['client_interest'] = mysqli_real_escape_string($conn, $client_interest);
    $insert_data['budget'] = mysqli_real_escape_string($conn, $budget);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['comments'] = mysqli_real_escape_string($conn, $message);
    $insert_data['createddate'] = date("Y-m-d H:i:s");
    $insert_data['modified_date'] = date("Y-m-d H:i:s");
    $insert_data['mailsent'] = "1";
    $insert_data['formname'] = mysqli_real_escape_string($conn, ucfirst($_POST['form_type']));
    $insert_data['IPAddr'] = mysqli_real_escape_string($conn, $ipaddress);
    $insert_id = $obj_lead->insertLead($insert_data, 0);
    
    if ($insert_id) {
        $fields = "`predr_formdetails`.*, `predr_reports`.*";
        $condition = "`predr_formdetails`.`id` = '" . $insert_id . "'";
        $lead_details = $obj_lead->getFullLeadDetails($fields, $condition, '', '', 0);
        $lead_detail = end($lead_details);
        
        /******************API Code For CRM*****************/
		$slug=$lead_detail['slug'];
		$prdurl_crm="https://www.precedenceresearch.com/";
		$url=$prdurl_crm.'precedencelogin/crm/apii.php';
        $ch = curl_init($url);
        
		$fullname=explode(" ",$lead_detail['firstname']);
        $lead_source = "Report-Page";
        $lead_source_category = "IB";
        $fname = ucfirst(trim($fullname[0]));
        $lname = isset($fullname[1]) ? ucfirst(trim($fullname[1])) : '';
        $email = trim($lead_detail['email']);
        $phone = trim($lead_detail['phone']);
        $intent =trim($lead_detail['client_interest']);
        $country = trim($lead_detail['country']);
        $job_title = trim($lead_detail['designation']);
        $company = trim($lead_detail['company']);
        $comment = trim($lead_detail['comments']);
        $website = SITETITLE;
        $request_from_page = trim($lead_detail['formname']);
        $report_url=SITEPATH.'insights/'.$slug;
        $report_url_mail = SITEPATH.'insights/'.$slug;
        $region="";
        $data = array(
          "lead_source" => $lead_source,
          "lead_source_category" => $lead_source_category,
          "fname" => $fname,
          "lname" => $lname,
          "email" => $email,
          "phone" => $phone,
          "client_intent" => $intent,
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
            $message .= '<p>Dear Team,<br><br>Personalized '.$_POST['form_type'].' from ' . $lead_detail['firstname'] .'. Please find the below details</p>';
            $message .= ' 
                      <table style="border-collapse:collapse;">  
                            <tr>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Item</td>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Title of report</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;"><a href="' . SITEPATH.'insights/'.$lead_detail['slug'] . '" target="_blank">' . $lead_detail['meta_title'] . '</a></td>  
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">'.$_POST['form_type'].' Request</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Category</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $category . '</td>
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
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Company</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['company'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['country'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Intent</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['client_interest'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Comment</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . nl2br($lead_detail['comments']) . '</td>
                            </tr> 
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Report Link</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . SITEPATH.'insights/'.$lead_detail['slug'] . '</td>
                            </tr> 
                           
                            
                        </table>
                        ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = $_POST['form_type']. " TP - " . $lead_detail['meta_title'] . "";

            $mailsent = sendReportMail($subject, $message);
            
            
            if(isset($lead_detail['country']) && !empty($lead_detail['country'])){
                $fields = "`name`,`region`";
                $condition = "`predr_countries_Region`.`name` = '" . $lead_detail['country'] . "'";
                $region_details = $obj_lead->getRegionDetails($fields, $condition, '', '', 0);
                $region_details = end($region_details);
                $region = $region_details['region'];
                $mailsent2 = sendReportMailRegion($subject, $message, $region);
                
            }
            
            if ($mailsent) {
                    
                /*                 * *** User Mail **** */
                $content = "<html>";
                $content .= "<head>";
                $content .= "<title>" . SITETITLE . " Received Your ".$lead_detail['meta_title']." </title>";
                $content .= "</head>";
                $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
                $content .= '<p>Dear ' .$_POST['fname'].',</p>';
                $content .= '<p>This is with reference to your interest in the <strong>' . $lead_detail['meta_title'] . '</strong> report.</p>
                             <p>We have done some extensive, granular level research and have a strong Analyst base that can handle any Research queries around this topic.</p>
                             <p>Let us know a convenient time for a quick call to better understand and cater to your requirement most appropriately.</p>
                             <p>You can also email me about specific aspects that you are looking for or contact us at <strong>'.SITEEMAIL.'</strong> OR <strong>+1 (407) 768-2028</strong>.</p>
                             <p>Looking forward to hearing from you.</p>
                             <p>Warm Regards,<br> Pramod Dige<br>' . SITETITLE . '</p>';
                $content .= "</body>";
                $content .= "</html>";

                $subject2 = SITETITLE . " Received Your Personalized ".$_POST['form_type']."";

                $sent_reciept = sendUserMail($lead_detail['email'], $subject2, $content);
                
                $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
                $response["message_code"] = 1;
                $response["report_id"] = trim($_POST['report_id']);
                 if($_POST['form_type']=="Customization")
                 {
                    header("Location:".SITEPATH."brochure-thanks/".$lead_detail['report_id']); 
                 }
                 elseif($_POST['form_type']=="Download Brochure")
                 {
                    $s = "personalized-toc";
                     header("Location:".SITEPATH."brochure-thanks/".$lead_detail['report_id']); 
                 }
                
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