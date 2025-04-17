<?php
require_once("precedence/classes/cls-paylink.php");
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");
//require_once("precedence/classes/cls-sample.php");

$obj_report = new Paylink();
$obj_category = new Category();
//$obj_sample = new Sample();
$noindex = "1";

$_SESSION['captcha']=rand(1000,9999);

function get_client_country_name() {
    $client_ip = $_SERVER['REMOTE_ADDR'];
    
    // Using ip-api.com to get location based on IP
    $url ="http://ip-api.com/json/{$client_ip}?fields=status,country";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    //echo "Raw Response: " . $response . "<br>";
    $location_data = json_decode($response, true);
    
    // Check if the request was successful and return the country name
    if ($location_data['status'] === 'success' && !empty($location_data['country'])) {
        return $location_data['country']; // Full country name
    }
    
    return null; // Return null if no country is detected
}
$detected_country_name = get_client_country_name(); // Get the detected full country name

if(isset($_GET['reportId']) && !empty($_GET['reportId'])){
    $reportId=$_GET['reportId'];
    $fields_report="*";
    $condition_report="`predr_paylinkspr`.`payid`='".base64_decode($reportId)."'";
    $report_detail_specifics=$obj_report->getPaylinkDetails($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);

}

if(isset($report_detail_specific) && !empty($report_detail_specific)){
    $page = "common"; 
    $meta_title="Order: ".$report_detail_specific['rname']."";
    $meta_keyword="Statifacts";
    $meta_description="";
}

?>
<?php include("header.php")?>
<link rel="stylesheet" href="<?php echo SITEPATH; ?>css/common.css">
<div class="ptb-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb mb-0">
                  <ol class="breadcrumb  mb-0 ">
                    <li class="breadcrumb-item">
                        <a href="<?php echo SITEPATH; ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a><?php echo $report_detail_specific['rname']; ?></a>
                    </li>    
                    <li class="breadcrumb-item active" aria-current="page">Purchase</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div class="container plr pb-4">
        <div class="row border p-3">
            
             <div class="col-md-1"></div>
            <div class="col-md-7">
               <h3 class="font-20 ">
                
                    <h1><?php echo $report_detail_specific['rname']; ?></h1>
            </h3>
                <form class="request-form space-right mt-4" method="POST" id="contactForm" name="contactForm" action="">
                    <input type="hidden" name="subscription_type" value="">     
                    <input type="hidden" name="report_id" id="report_id" value="<?php echo $report_detail_specific['rcode']; ?>">
                    <input type="hidden" name="form_type" id="form_type" value="Custom Link">
                    <input type="hidden" name="category" id="category" value="NA">
                    <input type="hidden" name="payment_amount" id="payment_amount" value="<?php echo $report_detail_specific['amount']; ?>">
                    <input type="hidden" name="name" id="name" value="<?php echo $report_detail_specific['cname']; ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $report_detail_specific['email']; ?>">
                    <input type="hidden" name="company" id="company" value="<?php echo $report_detail_specific['company']; ?>">
                    <input type="hidden" name="country" id="country" value="<?php echo $report_detail_specific['country']; ?>">
                    <input type="hidden" name="phone_no" id="phone_no" value="<?php echo $report_detail_specific['phone_no']; ?>">
                    <input type="hidden" name="payment_amount" id="payment_amount" value="<?php echo $report_detail_specific['amount']; ?>">
                
                <?php if(isset($_SESSION['caperr'])) { ?>
                    <div class="error">
                        <?php
                        echo $_SESSION['caperr'];
                        unset($_SESSION['caperr']);
                        ?>
                    </div> 
                <?php } ?>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" required placeholder="Enter Your Full Name *" data-error-msg="Please Enter Your Full Name" id="name" name="name" value="<?php echo $report_detail_specific['cname']; ?>" disabled>
                    <div class="invalid-feedback">Name field cannot be blank!</div>
                </div>
                <div class="form-group row">
                     <div class="col-md-6">        
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Use Corporate Email ID *" required data-error-msg="Please enter your Email" value="<?php echo $report_detail_specific['email']; ?>" disabled>
                    <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                    </div>
                    <div class="col-md-6">       
                      <label>Company</label>
                    <input type="text" class="form-control" name="company" id="company" placeholder="Use Company *" required data-error-msg="Please enter your Company" value="<?php echo $report_detail_specific['company']; ?>" disabled>
                    <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                    </div>
                </div>

                <div class="form-group">
                      
                </div>  
                <div class="form-group row">
                         <div class="col-md-6">        
                    <label>Country</label>
                      <input type="text" class="form-control" name="country" id="country" required data-error-msg="Please enter your Country" placeholder="Country *" value="<?php echo $report_detail_specific['country']; ?>" disabled>
                      <div class="invalid-feedback">Contact No field cannot be blank!</div>
              </div>    
          <div class="col-md-6">              
                      <label>Contact No</label>
                      <input type="text" class="form-control" name="phone_no" id="phone_no" required data-error-msg="Please enter your phone number" placeholder="Phone Number(Business) *" value="<?php echo $report_detail_specific['phone_no']; ?>" disabled>
                      <div class="invalid-feedback">Contact No field cannot be blank!</div>
                </div>      
        
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="payment_amount" id="payment_amount" placeholder="Amount" value="<?php echo $report_detail_specific['amount']; ?>" disabled>
                    <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea rows="2" col="15" class="form-control" id="address" name="address" placeholder="Write your address" required data-error-msg="Write your address"><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                </div>
                
                 <div class="row pt-5">
            	    <div class="col-md-8 offset-md-2">
                        <div id="paypal-button-container"></div>
                    </div>
            	 </div>
                
                <!--<div class="text-center pt-5">-->
                <!--    <button type="submit" class="btn common-btn btn-1">Download</button>-->
                <!--</div>-->
           
            </form>
            </div>
            <div class="col-md-3" style="margin-top: 5.3rem; font-size: 16px;">
                <div class="cust-hld-1 bg-white shadow mt-8">
                    <div class="p-4">
                        <table class="table buy-now-table mb-0">
                           
                            <tr>
                                <td class="fw-600">Report ID:</td>
                                <td><?php echo $report_detail_specific['rcode']; ?></td>
                            </tr>
                           
                            <tr>
                                <td class="fw-600">Source:</td>
                                <td>Towardspackaging</td>
                            </tr>
                          
                            <tr>
                                <td class="fw-600">
                                    <strong>Price</strong>
                                </td>
                                <td>
                                    <strong>USD <?php echo $report_detail_specific['amount']; ?></strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
             <div class="col-md-1"></div>
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="sub-ttl space-bottom-8">Trusted by industry leaders</h2>
                <img src="<?php echo SITEPATH;?>images/clients-logo.webp" alt="clients" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<?php include("footer.php")?>
 <script src="https://www.paypal.com/sdk/js?client-id=AW9UaduJj3wOP4sUF1uhF_01eWJ2movn8y3EWlFCSHv9mtus9FfNktkgnAla4-8ltM9bHvFzb8kver3K&currency=USD"></script>
 <script src="<?php echo SITEPATH; ?>js/paypal_script.js"></script>

<script>
(function () {
'use strict'
const forms = document.querySelectorAll('.request-form')
Array.from(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
       
      }
   
      form.classList.add('was-validated')
     }, false) 
  })
  
})()

function isNumber(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

 return true;
}
</script>