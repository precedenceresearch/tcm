<?php
require_once("precedence/classes/cls-report.php");

$obj_report = new Report();

$_SESSION['captcha']=rand(1000,9999);

$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);

// Get Country by ip address
// Function to get full country name from IP using ip-api.com
function get_client_country_name() {
    $client_ip = $_SERVER['REMOTE_ADDR'];
    
    // Using ip-api.com to get location based on IP
    $url = "http://ip-api.com/json/{$client_ip}?fields=status,country";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $location_data = json_decode($response, true);
    
    // Check if the request was successful and return the country name
    if ($location_data['status'] === 'success' && !empty($location_data['country'])) {
        return $location_data['country']; // Full country name
    }
    
    return null; // Return null if no country is detected
}

$detected_country_name = get_client_country_name(); // Get the detected full country name

// End Country by ip address

$page = "common"; 
$meta_title="Contact Towards Chemicals & Materials | Get in Touch";
$meta_keyword="";
$meta_description="Have questions or need assistance? Contact Towards Chemicals & Materials for more information, support, or inquiries about our chemical and materials reports and services.";
?>
<?php include("header.php")?>
<div class="gradient-bg ptb report-banner pt-0">
    <div class="container">
        <div class="row pb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-white">
                        <a href="<?php echo SITEPATH; ?>">
                            <img src="images/home-page/Home-light.png" alt="home-icon" class="img-fluid home-icon" width="14" height="14">
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Contact Us</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="ttl text-white text-center mb-0">Contact Us</h1>
                <p class="para text-white text-center">Reach out to us through a medium of your choice and we'll get back to you.</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 mb-5">
            <div class="bg-shadow">
                <h2 class="ttl text-center pb-5 contact-ttl mb-5">Thank you for your interest in our research. 
                    Please use this general contact form for any request you may have
                </h2>
                <div class="row">
                    <div class="col-md-4 offset-md-1">

                        <div class="bg-dark-blue contact-holder">
                            <img src="<?php echo SITEPATH;?>images/mail-icon.webp" alt="mail" class="img-fluid" width="30" height="30">
                            <div>
                                <p class="mb-0 text-dark">Have any questions?<p>
                                <a href="mailto:<?php echo SITEEMAIL;?>" class="text-dark">sales@towardschemandmaterials.com</a>
                            </div>
                        </div>
                        <div class="bg-dark-blue2 contact-holder">
                            <img src="<?php echo SITEPATH;?>images/location-icon.webp" alt="location" class="img-fluid" width="30" height="30">
                            <div>
                                <p class="mb-0">Address<p>
                                    
                                    

                                <span>Apt 1408 1785 Riverside<span class="d-block"></span>Drive Ottawa, ON, K1G 3T</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form class="request-form space-left" novalidate method="POST" action="<?php echo SITEPATH;?>contact-us-action.php">
                                  <input type="hidden" name="capsess" id="capsess" value="<?php echo $_SESSION['captcha'];?>">
                                  <input type="hidden" name="form_type" id="form_type" value="Contact Us">
                                  <input type="hidden" name="form_type_table" id="form_type_table" value="CONTACT-US">
                                <?php if(isset($_SESSION['caperr'])) { ?>
                                    <div class="error">
                                        <?php
                                        echo $_SESSION['caperr'];
                                        unset($_SESSION['caperr']);
                                        ?>
                                    </div> 
                                <?php } ?>
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required data-error-msg="Please enter your name" id="fname" name="fname" value="<?php if(isset($_POST['fname'])){ echo $_POST['fname'];}?>">
                                    <div class="invalid-feedback">Name field cannot be blank!</div>
                                </div>
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Use Corporate Email ID" required data-error-msg="Please enter your Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
                                    <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                      <label>Country<span class="text-danger">*</span></label>
                                      <select class="form-select" name="country" id="country" required data-error="Please select country">
                                    <option value="">--Select Country--</option>
                                    <?php foreach ($country_details as $country) { ?>
                                        <option value="<?php echo $country['phonecode'].'*'.$country['name']; ?>" 
                                            <?php
                                            // Preselect the country if it's detected or already submitted
                                            if ((isset($detected_country_name) && $detected_country_name == $country['name']) || 
                                                (isset($_POST['country']) && $_POST['country'] == $country['name'])) {
                                                echo "selected";
                                            }
                                            ?>>
                                            <?php echo $country['name']; ?> (+<?php echo $country['phonecode']; ?>)
                                        </option>
                                    <?php } ?>
                                </select>
                                      <div class="invalid-feedback">Please select country!</div>
                                    </div>
                                    <div class="col-md-6">
                                      <label>Contact No<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" name="phone_no" id="phone_no" required data-error-msg="Please enter your phone number" maxlength="12" value="<?php if(isset($_POST['phone_no'])){echo $_POST['phone_no'];}?>" onkeypress="return isNumber(event)">
                                      <div class="invalid-feedback">Contact No field cannot be blank!</div>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <div class="col-md-6">
                                      <label>Company<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" name="company" id="company" required value="<?php if(isset($_POST['company'])){ echo $_POST['company'];}?>">
                                      <div class="invalid-feedback">Company field cannot be blank!</div>
                                    </div>
                                    <div class="col-md-6">
                                      <label>Designation<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" name="designation" id="designation" required value="<?php if(isset($_POST['designation'])){ echo $_POST['designation'];}?>">
                                      <div class="invalid-feedback">Designation field cannot be blank!</div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Message<span class="text-danger">*</span></label>
                                    <textarea row="5" col="15" class="form-control" id="message" name="message" required data-error-msg="Write your message"><?php if(isset($_POST['message'])){ echo $_POST['message'];}?></textarea>
                                    <div class="invalid-feedback">Message field cannot be blank!</div>
                                </div>
                                <div class="s-code d-flex">
                                    <div class="code-holder me-5">
                                        <span><?php echo $_SESSION['captcha'];?></span>
                                    </div>
                                    <input type="text" class="w-50 mb-0 form-control" name="captchatxt" id="captchatxt" placeholder="Security code" maxlength="4" required>
                                    <div class="invalid-feedback">Security Code field cannot be blank!</div>
                                    <div class="invalid-feedback" id="invalid-captcha" style="display:none;">Invalid Captcha!</div>
                                </div>
                                <div class="text-center pt-4">
                                    <button type="submit" class="btn grn-btn">Submit
                                      
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php")?>
<style>
.captcha-code h4 {
    font-size: 3.4rem;
}
.capbox{
    height:64px;width:284px;
}
 .selbox{
    padding-bottom:0.9rem!important;
    font-size:1.3rem!important;
   
}
.invalid-feedback{
    color: #ff606e;
    font-size: 1.3rem;
    font-weight:500;
}
.error{
    color: #ff606e;
    font-size: 1.3rem;
    font-weight:500;
}
</style>
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