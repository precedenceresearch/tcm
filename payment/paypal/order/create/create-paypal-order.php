<?php
require_once("/home/towardspackaging/public_html/precedence/classes/cls-leads.php");
require_once("/home/towardspackaging/public_html/precedence/classes/phpmailer.php");
require_once("/home/towardspackaging/public_html/precedence/classes/cls-report.php");
$obj_lead = new Lead();
$obj_report = new Report();
$conn = $obj_lead->getConnectionObj();
ob_start();
if(session_id() == '') {
    session_start();
}
$pc=0; $chk=""; $LType=""; $ltype=""; $LTType="";

$json_data = file_get_contents('php://input');

// Decode the JSON data to an associative array
$form_data = json_decode($json_data, true);

function generateUniqueCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = str_shuffle($characters);
    return substr($code, 0, 10);
}

$uniqueCode = generateUniqueCode();

// Check if 'form_type' exists in the $_POST array
if (isset($form_data['form_type'])) {
    if ($form_data['form_type'] == "Buy Now" || $form_data['form_type'] == "Custom Link" ) {
        $prid = isset($form_data['report_id']) ? $form_data['report_id'] : 0; // Ensure $form_data['report_id'] is defined
        $nor = rand(10, 1000);
        $uniqueID = rand(10, 1000);
    } elseif ($form_data['form_type'] == "Annual Subscription") {
        $nor = rand(10, 1000);
        $prid = 777;
        $uniqueID = rand(10, 1000);
    } else {
        $uniqueID = 0; // Default value if form_type is unrecognized
    }
} else {
    // Handle case where 'form_type' is not set
    $uniqueID = 0;
}

// Further processing using $uniqueID
// Ensure $uniqueID is always defined to avoid warnings


// $LTType=$form_data['lty'];
// $licen_type="Single";

$_POST = $form_data;

$TranAmount = $form_data['payment_amount'];

// Replace 'YOUR_CLIENT_ID' and 'YOUR_CLIENT_SECRET' with your actual PayPal API credentials
$clientId = 'AW9UaduJj3wOP4sUF1uhF_01eWJ2movn8y3EWlFCSHv9mtus9FfNktkgnAla4-8ltM9bHvFzb8kver3K';
$clientSecret = 'ELAi9nGGEC-xHHTctbXW6_Moky6vvTRIcFYinqoyvjtf9FB9D3XtB1Go1a9JBeN6mjlkuBUJoJuocB_c';
$apiBaseUrl = "https://api-m.paypal.com";
//$apiBaseUrl = "https://api-m.sandbox.paypal.com";
$authString = base64_encode($clientId . ':' . $clientSecret);

$orderData = array(
    "intent" => "CAPTURE",
    "payment_source" => array(
        "paypal" => array(
            "experience_context" => array(
                "brand_name" => "towardspackaging",
                "shipping_preference" => "NO_SHIPPING",
                "user_action" => "PAY_NOW",
                "return_url" => "https://www.towardspackaging.com/paypal-thanks.php",
                "cancel_url" => "https://www.towardspackaging.com/paypal-cancelled-pay.php",
                "payment_method_selected" => "PAYPAL",
                "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED"
            ),
            "name" => array(
                "given_name" => $_POST['name']
            ),
            "email_address" => $_POST['email'],
            "phone" => array(
                "phone_number" => array(
                    "national_number" => $_POST['phone_no']
                )
            )
        )
    ),
    "purchase_units" => array(
        array(
            "amount" => array(
                "currency_code" => "USD",
                "value" => $TranAmount,
                "breakdown" => array(
                    "item_total" => array(
                        "currency_code" => "USD",
                        "value" => $TranAmount
                    )
                )
            ),
            "items" => array(
                array(
                    "name" => "Product ID - # $uniqueID",
                    "description" => "Online Research Report Order Id - $uniqueID",
                    "quantity" => "1",
                    "unit_amount" => array(
                        "currency_code" => "USD",
                        "value" => $TranAmount
                    ),
                    "category" => "DIGITAL_GOODS"
                )
            ),
            "soft_descriptor" => "towardspackaging",
            "custom_id" => $uniqueID,
            "invoice_id" => "$uniqueID"
        )
    )
);

// Debugging order data before sending it to PayPal API
error_log('Order Data: ' . print_r($orderData, true)); // Logs the order data to your server's error log

$uniqueCode = generateUniqueCode();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/v2/checkout/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . $authString,
    "PayPal-Request-Id: $uniqueCode"
));

	$result = curl_exec($ch);
    curl_close($ch);

    $orderData = json_decode($result, true);
    
if (isset($orderData['error'])) {
    http_response_code(500);
    echo json_encode(array('error' => 'PayPal API Error: ' . $orderData['error']['message']));
    exit();
}


// Check if the PayPal API response contains an order ID
if (empty($orderData['id'])) {
    http_response_code(500);
    echo json_encode(array('error' => 'Error creating PayPal order: Invalid API response.'));
    exit();
}else{
    
// Send a JSON response with the order ID
http_response_code(200);
header('Content-Type: application/json');
echo json_encode(array('id' => $orderData['id'],'ltype'=>$TranAmount));

$_POST['transactionNo'] = $orderData['id'];

if(isset($_POST) || !empty($TranAmount))
{
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $name=addslashes(ucfirst(trim($_POST['name'])));
    $email=trim($_POST['email']);
    $countrywcode=explode("*",$_POST['country']);
    $country=$_POST['country'];
    $phoneno=$_POST['phone_no'];
    $address=addslashes(trim($_POST['address']));
    $category=$_POST['category'];
    
    $inv = "SF-2526-".$_POST['report_id']."";
    
    if(isset($_POST['company']) && !empty($_POST['company'])){
        $company = $_POST['company'];
    }else{
        $company = "NA";
    }
    
    $insert_data['firstname'] = mysqli_real_escape_string($conn, $name);
    $insert_data['email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['phone'] = mysqli_real_escape_string($conn, $phoneno);
    $insert_data['country'] = mysqli_real_escape_string($conn, $country);
    $insert_data['report_id'] = mysqli_real_escape_string($conn, isset($_POST['report_id']) ? $_POST['report_id'] : '');
    $insert_data['price'] = mysqli_real_escape_string($conn, $_POST['payment_amount']);
    //$insert_data['company'] = mysqli_real_escape_string($conn, $company);
    $insert_data['company'] = mysqli_real_escape_string($conn, isset($company) ? $company : '');
    $insert_data['address'] = mysqli_real_escape_string($conn, isset($address) ? $address : '');
    $insert_data['invoiceNo'] = mysqli_real_escape_string($conn, $inv);
    $insert_data['transactionNo'] = mysqli_real_escape_string($conn, $_POST['transactionNo']);
    $insert_data['payment_status'] = mysqli_real_escape_string($conn, "Pending");
    $insert_data['createddate'] = date("Y-m-d H:i:s");
    $insert_data['modified_date'] = date("Y-m-d H:i:s");
    $insert_data['mailsent'] = "1";
    $insert_data['formname'] = mysqli_real_escape_string($conn, ucfirst($_POST['form_type']));
    $insert_data['IPAddr'] = mysqli_real_escape_string($conn, $ipaddress);
    $insert_id = $obj_lead->insertLead($insert_data, 0);
    
    if($_POST['form_type']=="Buy Now" || $_POST['form_type']=="Custom Link"){
  
    $fields_report="*";
    $condition_report="`predr_reports`.`report_id`='".$prid."'";
    $report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
   
    $lead_detailReport=end($report_detail_specifics);
    
        $product_title = $lead_detailReport['reportSubject'];
            
            if (strpos($product_title, 'Market') !== false) {
            
            $prod_title = strstr($product_title, 'Market', true);
            
            $prod_title = substr_replace($prod_title, " Market", -1);
            
            }
            else
            {
                $prod_title = str_replace("-", " ", $lead_detailReport['reportSubject']);
                $prod_title = ucwords($prod_title);
            }
    
    
            
            $message_full = "<html>";
            $message_full .= "<head>";
            $message_full .= "<title></title>";
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
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">
                                <a href="' . SITEPATH.'outlook/'.$lead_detailReport['slug'].'" target="_blank">' . $lead_detailReport['meta_title'] . '</a>
                                </td>  
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Source of Lead</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">'.$_POST['form_type'].'</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Amount</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">USD ' . $_POST['payment_amount'] . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Payment Status</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Pending</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Report ID</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $prid . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Name</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $name . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Phone Number</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $phoneno . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Email Id</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $email . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">Country</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $country . '</td>
                            </tr>
                            <tr>
                                <th style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">IP Address</th>
                                <td style="border: 0.3px solid #0000000d; text-align: left; padding: 8px;">' . $ipaddress . '</td>
                            </tr> 
                            
                        </table>
                        ';  
            $message_full .= "</body>";
            $message_full .= "</html>";
            
            $subject = $_POST['form_type']." - " . $prod_title . "";
            
    }
            
            $mailsent = sendReportMail($subject, $message_full);
              
    
    // End Send Mail
    
}

////  Risk APi

$todayDate = date("Y-m-d\TH:i:s.vP");

$orderDataID = $orderData['id'];

$additional_data = array(
    array(
        "key" => "sender_first_name",
        "value" => $_POST['name'],
    ),
    array(
        "key" => "sender_email",
        "value" => $_POST['email'],
    ),
    array(
        "key" => "sender_phone",
        "value" => $_POST['phone_no'],
    ),
    array(
        "key" => "sender_country_code",
        "value" => $_POST['country'],
    ),
    array(
        "key" => "sender_create_date",
        "value" => $todayDate,
    )
);
$merchantID = "MY3D77DXB5JL6";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiBaseUrl . '/v1/risk/transaction-contexts/'.$merchantID.'/'.$orderDataID);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($additional_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Basic ' . $authString,
));

$response_risk = curl_exec($ch);
curl_close($ch);
}