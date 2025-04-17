<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$_SESSION['captcha']=rand(1000,9999);


$fields_report="report_id,meta_title,CatId,reportDate,popular,No_Pages,reportSubject,reportLDesc,slug";
if(is_numeric($_GET['q'])){
    $condition_report = "`predr_reports`.`status`='Active' and `predr_reports`.`report_id`='".$_GET['q']."'";
}else{
$condition_report="`predr_reports`.`status`='Active' and (`reportSubject` like '%".$_GET['q']."%' or `reportSubject` like '%".$_GET['q']."' or `reportSubject` like '".$_GET['q']."%')";   
}   
$orderby_report="`predr_reports`.`report_id` desc";
$report_details=$obj_report->getReportDetails($fields_report,$condition_report,$orderby_report,'',0);

$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);

$page ="search"; 
$meta_title="Towards Packaging - Packaging Knowledge Services";
$meta_keyword="Towards Packaging, Business Consulting, Packaging Consulting, Intelligence Centers, Company Analytics";
$meta_description="Towards Packaging is a full-service packaging consulting firm dedicated to the provision of business intelligence for primary and healthcare packaging, food and beverages, flexible and protective packaging.";
$noindex="noindex";
?>
<style>
    .pagedots{
        font-size: 1.2rem;
        color: #000;
        padding: 0.7rem 1.2rem;
        border-radius: 0.5rem;
    }
     #search-holder::placeholder {
        color: #fff9;
        opacity: 1; /* Ensures full opacity of the color */
    }
      /* For Internet Explorer */
      #search-holder:-ms-input-placeholder {
        color: #fff9;
      }
      /* For older versions of Microsoft Edge */
      #search-holder::-ms-input-placeholder {
        color:#fff9;
      }
</style>
<?php include("header.php");?>
 <div class="gradient-bg ptb contact-us-bannerr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="pb-4 text-white text-center mb-0">SEARCH RESULT FOR</h1>
                <p class="para text-white text-center"><?php echo $_GET['q'];?></p>
            </div>
        </div>
    </div>
</div>
<div class="container bpad">
    <div class="row align-items-center pb-5">
    </div>
        <div class="row">
            <div class="col-md-9">
                <?php 
                    if(isset($report_details) && !empty($report_details))
                    {
                    foreach($report_details as $report_detail){
                    $fields_category="*";
                    $condition_report_category="`predr_category`.`catId`='".$report_detail['CatId']."'";
                    $category_report_details=$obj_category->getCategoryDetails($fields_category, $condition_report_category, '', '', 0);
                    $category_report_detail=end($category_report_details);
                ?>
                <div class="report-lists">
                    <p class="mb-0 date-data"><?php echo date("F d, Y",strtotime($report_detail['reportDate']));?></p>
                    <h3>
                        <a href="<?php echo SITEPATH.'insights/'.$report_detail['slug'];?>">
                            <?php echo str_replace("-","-",$report_detail['reportSubject']);?>
                        </a>
                    </h3>
                    <ul class="list-unstyled d-flex mb-0 pb-4">
                        <li class="ps-0">
                          <strong>Status :</strong>
                            Published
                        </li>
                        <li>
                          <strong>No. of Pages:</strong>
                            <?php echo $report_detail['No_Pages'];?></li>
                        <li class="remrightborder">
                          <strong>Category :</strong>
                            <?php echo $category_report_detail['catName'];?>  </li>
                      </ul>
                    <p class="para mb-0"><?php echo substr(strip_tags(trim($report_detail['reportLDesc'])), 0, 250) . "...";?></p>
                </div>
                <?php } } else {?>
                <div class="report-lists">
                   <h2 class="green-txt text-center">No Reports Found</h2>
                </div>
                <?php }?>
                <?php  if(empty($report_details)){?>
                <div class="bg-shadow">
                    <h2 class="ttl green-txt text-center pb-5">Thank you for your interest in our research. 
                        Please use this general search form for the report you may have
                    </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="request-form" novalidate method="POST" action="<?php echo SITEPATH;?>search-action.php">
                                 <input type="hidden" name="capsess" id="capsess" value="<?php echo $_SESSION['captcha'];?>">
                                 <input type="hidden" name="search_text" id="search_text" value="<?php echo $_GET['q'];?>">
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
                                    <input type="email" class="form-control" name="email" id="email" required data-error-msg="Please enter your Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
                                    <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                      <label>Country<span class="text-danger">*</span></label>
                                      <select class="form-select selbox" name="country" id="country" required>
                                      <option value="">Select Country</option>
                                      <?php foreach($country_details as $country_detail){?>
                                      <option value="<?php if(isset($_POST['country'])){ echo $_POST['country'];}else{ echo $country_detail['phonecode']."*".$country_detail['name'];}?>"><?php echo $country_detail['name']." (+".$country_detail['phonecode'].")";?></option>
                                      <?php }?>
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
                                <div class="text-center pt-5">
                                    <button type="submit" class="btn blck-btn">Submit
                                        <img src="<?php echo SITEPATH; ?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                                    </button>
                                </div>
                            </form>
                        </div>
                </div>
                </div>
                <?php }?>
            </div>
            <div class="col-md-3">
                <div class="gradient-bg p-4 text-white text-center mb-4">
                    <h3>For Any Query</h3>
                    <p class="para text-white">Please drop a mail to the Global 
                    PR Team for your queries</p>
                    <a href="<?php echo SITEPATH;?>contact-us" class="btn blck-btn bg-white text-dark">Contact Us
                        <img src="<?php echo SITEPATH; ?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                </div>
                
                <div class="option-main">
                   <h3 class="purple-txt pb-3 mb-0 mt-5">Quick Contact</h3>
                    <div class="outer-main bg-dark-yl w-100">
                        <a href="tel:+1 650 460 3308">
                            <img src="<?php echo SITEPATH;?>images/Mobile.webp" alt="call" class="img-fluid activity-icon">
                            +1 650 460 3308
                        </a>
                        <a href="tel:+91 87933 22019">
                            <img src="<?php echo SITEPATH;?>images/call-gr.webp" alt="call" class="img-fluid activity-icon">
                            +91 87933 22019
                        </a>
                        <a href="mailto:sales@towardspackaging.com">
                            <img src="<?php echo SITEPATH;?>images/mail-gr.webp" alt="location" class="img-fluid activity-icon">
                            sales@towardspackaging.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include("footer.php");?>
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