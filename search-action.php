<?php
require_once("precedence/classes/cls-search.php");
require_once("precedence/classes/phpmailer.php");

$obj_search = new Search();


$conn = $obj_search->getConnectionObj();

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
    
    
    $insert_data['name'] = mysqli_real_escape_string($conn, $name);
    $insert_data['email_id'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone_no'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['message'] = mysqli_real_escape_string($conn, $message);
    $insert_data['company'] = mysqli_real_escape_string($conn, trim($_POST['company']));
    $insert_data['designation'] = mysqli_real_escape_string($conn, trim($_POST['designation']));
    $insert_data['status'] = "Active";
    $insert_data['created_at'] = date("Y-m-d H:i:s");
    $insert_data['updated_at'] = date("Y-m-d H:i:s");
    $insert_data['search_text'] = mysqli_real_escape_string($conn, addslashes($_POST['search_text']));
    $insert_data['ip_address'] = mysqli_real_escape_string($conn, $ipaddress);
    $insert_id = $obj_search->insertSearch($insert_data, 0);
    
    if ($insert_id) {
        $fields = "*";
        $condition = "`predr_search`.`search_id` = '" . $insert_id . "'";
        $search_details = $obj_search->getSearchDetails($fields, $condition, '', '', 0);
        $search_detail = end($search_details);
        
        
        if (isset($search_detail) && !empty($search_detail)) {
            $message = "<html>";
            $message .= "<head>";
            $message .= "<title>Search Report Request from " . $search_detail['name'] . " – " . $search_detail['country'] . "</title>";
            $message .= "</head>";
            $message .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message .= '<p>Dear Team,<br><br>Search report request has been initiated. Please find the below details</p>';
            $message .= '<table style="border-collapse:collapse;">  
                            <tr>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Item</td>
                                <th style="background-color: #5450c1; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Search For</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">'.$search_detail['search_text'].'</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Name</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['name'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Phone Number</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['phone_no'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email Id</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['email_id'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['country'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Company</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['company'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Designation</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['designation'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Comment</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . nl2br($search_detail['message']) . '</td>
                            </tr>  
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">IP Address</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $search_detail['ip_address'] . '</td>
                            </tr>
                        </table>
                        ';  
            $message .= "</body>";
            $message .= "</html>";

            $subject = "Search Report Request from " . $search_detail['name'] . " - " . $search_detail['country'] . "";

            $mailsent = sendReportMail($subject, $message);
            if ($mailsent) {
                    
               
                /*                 * *** User Mail **** */
                $content = "<html>";
                $content .= "<head>";
                $content .= "<title>" . SITETITLE . " Received Your Search Request</title>";
                $content .= "</head>";
                $content .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
                $content .= '<p>Dear ' .$search_detail['name'].',</p>';
                $content .= '<p>We have received your search request for <b>'.$search_detail['search_text'].'</b></p>';
                $content .= '<p>We have done some extensive, granular level research and have a strong Analyst base that can handle any Research queries around this topic.</p>
                             <p>Let us know a convenient time for a quick call to better understand and cater to your requirement most appropriately.</p>
                             <p>You can also email me about specific aspects that you are looking for or contact us at <strong>'.SITEEMAIL.'</strong> OR <strong>+1 (407) 768-2028</strong>.</p>
                             <p>Looking forward to hearing from you.</p>
                             <p>Warm Regards,<br> Pramod Dige<br>' . SITETITLE . '</p>';
                $content .= "</body>";
                $content .= "</html>";

                $subject2 = SITETITLE . " Received Your Search Request";

                $sent_reciept = sendUserMail($search_detail['email_id'], $subject2, $content);
                
                $response["message"] = "<strong>Congratulations</strong> Your Request has been processes successfully";
                $response["message_code"] = 1;
               
                header("Location:".SITEPATH."search/thank-you"); 
                
                
            }
            else
            {
                $response["message"] = "<strong>Congratulations</strong> Your Request not get recieved";
                $response["message_code"] = 0;
                
                 header("Location:".SITEPATH."404"); 
            }
                /*                 * *** User Mail **** */
              
        }
    }
}

?>