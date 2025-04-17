<?php
require_once("/home/towardspackaging/public_html/precedence/classes/cls-leads.php");
require_once("/home/towardspackaging/public_html/precedence/classes/phpmailer.php");
$obj_lead = new Lead();
$conn = $obj_lead->getConnectionObj();

// Replace 'YOUR_CLIENT_ID' and 'YOUR_CLIENT_SECRET' with your actual PayPal API credentials
$clientId = 'AW9UaduJj3wOP4sUF1uhF_01eWJ2movn8y3EWlFCSHv9mtus9FfNktkgnAla4-8ltM9bHvFzb8kver3K';
$clientSecret = 'ELAi9nGGEC-xHHTctbXW6_Moky6vvTRIcFYinqoyvjtf9FB9D3XtB1Go1a9JBeN6mjlkuBUJoJuocB_c';
$apiBaseUrl = "https://api-m.paypal.com";
//$apiBaseUrl = "https://api-m.sandbox.paypal.com";

$authString = base64_encode($clientId . ':' . $clientSecret);
$orderID = $_REQUEST['orderID'];

// New Code

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => ''.$apiBaseUrl.'/v1/oauth2/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded',
   'Authorization: Basic ' . $authString,
  ),
));
$response = curl_exec($curl);
$jsonData = json_decode($response, true);
$accessToken = $jsonData["access_token"];
// End

function generateUniqueCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = str_shuffle($characters);
    return substr($code, 0, 10);
}

$uniqueCode = generateUniqueCode();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiBaseUrl.'/v2/checkout/orders/'.$orderID.'/capture');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken",
    "PayPal-Request-Id: $uniqueCode",
    "PayPal-Client-Metadata-Id: $orderID"
));
$response = curl_exec($ch);
curl_close($ch);
// Add the debug output to the JSON response
$jsonData = json_decode($response, true);

$paymentCaptureId = $jsonData['purchase_units'][0]['payments']['captures'][0]['id'];

$paymentStatus = $jsonData['purchase_units'][0]['payments']['captures'][0]['status'];

if($paymentStatus=='COMPLETED'){
    $condition = "`predr_formdetails`.`transactionNo`='" . mysqli_real_escape_string($conn, $orderID) . "'";
    $update_data['payment_status'] = mysqli_real_escape_string($conn, "COMPLETED");
    $update_data['transaction_id'] = mysqli_real_escape_string($conn, $paymentCaptureId);
    $update_data['modified_date'] = date("Y-m-d H:i:s");
    $update_data = $obj_lead->updateLead($update_data,$condition, 0);
    
    $fields="*";
    $condition="`predr_formdetails`.`transaction_id`='".$paymentCaptureId."'";
    $lead_details_lead =$obj_lead->getLeadDetails($fields,$condition,'','',0);
    $lead_details_lead = end($lead_details_lead);
    
    // Send Mail
    
        if ($update_data) {
            
        if($lead_details_lead['formname']=="Buy Now" || $lead_details_lead['formname']=="Custom Link"){   
            
            $fields = "`predr_formdetails`.*, `predr_reports`.*";
            $condition = "`predr_formdetails`.`transaction_id` = '" . $paymentCaptureId . "'";
            $lead_details = $obj_lead->getFullLeadDetails($fields, $condition, '', '', 0);
            $lead_detail = end($lead_details);
            
             //******** Get Country name *********///// 
          //  $country = $lead_detail['country'];    
                
            // $fields = "`predr_countries_Region`.*";
            // $condition = "`predr_countries_Region`.`name` = '" . $country . "'";
            // $lead_details = $obj_lead->getFullRegionDetails($fields, $condition, '', '', 0);
            
            // foreach($lead_details as $ff){ }
            // $regionName = $ff['region'];   
        
         //******** End Get Country name *********///// 
        
        if (isset($lead_detail) && !empty($lead_detail)) {
            
            $message_full = "<html>";
            $message_full .= "<head>";
            $message_full .= "<title>".$lead_detail['formname']." Request " . $lead_detail['meta_title'] . "</title>";
            $message_full .= "</head>";
            $message_full .= "<body  style='font-family:Segoe UI; font-size:13px;'>";
            $message_full .= ' 
                      <table style="border-collapse:collapse;">  
                            <tr>
                                <th style="background-color: #00c8ff; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Item</td>
                                <th style="background-color: #00c8ff; color: #fff;border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Client Details</td>
                            </tr>
                            
                            
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Title of report</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;"><a href="' . SITEPATH.$lead_detail['slug'].'outlook/'.$lead_detail['slug']. '" target="_blank">' . $lead_detail['meta_title'] . '</a></td>  
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">'.$lead_detail['formname'].'</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Amount</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">USD ' . $lead_detail['price'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Payment Status</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">COMPLETED</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Report ID</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['report_id'] . '</td>
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
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">IP Address</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $lead_detail['IPAddr'] . '</td>
                            </tr> 
                            
                        </table>
                        ';  
            $message_full .= "</body>";
            $message_full .= "</html>";

            $subject = $lead_detail['formname']." - " . $lead_detail['meta_title'] . "";
            
            $mailsent = sendReportMail($subject, $message_full);
            
            $responseData = array(
            'status' => $paymentStatus,
            'transaction_id' => $paymentCaptureId,
            'randomNo' => $uniqueCode
        );
        header('Content-Type: application/json');
        echo json_encode($responseData);
              
        }
        
    }
        
    }
    
    // End Send Mail

}else{
    $condition = "`predr_formdetails`.`transactionNo`='" . mysqli_real_escape_string($conn, $orderID) . "'";
    $update_data['payment_status'] = mysqli_real_escape_string($conn, "FAILED");
    $update_data['modified_date'] = date("Y-m-d H:i:s");
    $update_data = $obj_lead->updateLead($update_data,$condition, 0);
}
?>