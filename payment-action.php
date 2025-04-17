<?php
session_start();
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");
require_once("precedence/classes/phpmailer.php");

$obj_report = new Report();
$obj_lead = new Lead();

$conn = $obj_lead->getConnectionObj(); 

if(isset($_POST))
{
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $name=addslashes(ucfirst(trim($_POST['fname'])));
    $email=trim($_POST['email']);
    $countrywcode=explode("*",$_POST['country']);
    $country=$countrywcode[1];
    $phoneno="+".$countrywcode[0]." ".trim($_POST['phone_no']);
    $address=addslashes(trim($_POST['address']));
    $category=$_POST['category'];
    if(isset($_POST['company_title']) && !empty($_POST['company_title'])){
        $companyTitle = "Top Companies";
    }
    
    $insert_data['firstname'] = mysqli_real_escape_string($conn, $name);
    $insert_data['email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['price'] = mysqli_real_escape_string($conn, $_POST['payment_amount']);
    $insert_data['address'] = mysqli_real_escape_string($conn, $address);
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
        
        
        if (isset($lead_detail) && !empty($lead_detail)) {
            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>".$_POST['form_type']." Request from " . $lead_detail['firstname'] . " – " . $lead_detail['country'] . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= ' 
                      <table style="border-collapse:collapse;">  
                            <tr>
                                <th style="background-color: #00c8ff; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Item</td>
                                <th style="background-color: #00c8ff; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Title of report</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;"><a href="' . (isset($companyTitle) && !empty($companyTitle) ? SITEPATH.'companies' : SITEPATH.$lead_detail['slug']) . '" target="_blank">' . (isset($companyTitle) && !empty($companyTitle) ? $_POST['company_title'] : $lead_detail['meta_title']) . '</a></td>  
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . 
                                (isset($companyTitle) && !empty($companyTitle) ? $companyTitle : $_POST['form_type']) . 
                                '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Report ID</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['report_id'] . '</td>
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
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['country'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Address</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . nl2br($lead_detail['address']) . '</td>
                            </tr>  
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Price</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">USD ' . $lead_detail['price'] . '</td>
                            </tr>  
                            
                        </table>
                        ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = $_POST['form_type']." Request from " . $lead_detail['firstname'] . " - " . $lead_detail['country'] . "";

            $mailsent = sendReportMail($subject, $message);
           
         
            $mailsent = sendReportMail($subject, $message);
            
            $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
                $response["message_code"] = 1;
               
                header("Location:".SITEPATH."contact-thank-you"); 
              
        }
    }
}

?>