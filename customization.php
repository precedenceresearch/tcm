<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$_SESSION['captcha']=rand(1000,9999);

if(isset($_GET['reportid']))
{
    $reportid=$_GET['reportid'];
    $fields_report="report_id,CatId,Price_SUL,Price_CUL,Price_Multi,slug,meta_title,meta_description,meta_keywords";
    $condition_report="`predr_reports`.`report_id`='".$reportid."'";
    $report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);
    $fields_category = "catId,catName,slug";
    $condition_category="`predr_category`.`catId`='".$report_detail_specific['CatId']."'";
    $category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);
    $category_detail=end($category_details);
}
$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);

$page = "common"; 
$meta_title="Customization Request - ".ucfirst($report_detail_specific['meta_title']); 
$meta_keyword="";
$meta_description="";
$noindex="noindex";
?>
<?php include("header.php")?>
<div class="">
    <div class="container">
        <!--<div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--        <nav aria-label="breadcrumb">-->
        <!--          <ol class="breadcrumb">-->
        <!--            <li class="breadcrumb-item"><a href="#">Home</a></li>-->
        <!--            <li class="breadcrumb-item active" aria-current="page">Customization</li>-->
        <!--          </ol>-->
        <!--        </nav>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo SITEPATH;?>images/Form_Pattern_Left.webp" class="top-pattern" class="img-fluid">
            </div>
        </div>
        <div class="row ptb" style="padding-bottom:12rem">
            <div class="col-lg-5 offset-lg-1 col-md-6">
                <h1 class="ttl purple-txt pb-3 mb-0">Request Customization</h1>
                <a class="report-hyper-link" href="<?php echo SITEPATH.'insights/'.$report_detail_specific['slug'];?>"><?php echo $report_detail_specific['meta_title'];?></a>
                
                <form class="request-form" novalidate method="POST" action="<?php echo SITEPATH;?>form-action.php">
                    <input type="hidden" name="capsess" id="capsess" value="<?php echo $_SESSION['captcha'];?>">
                    <input type="hidden" name="report_id" id="report_id" value="<?php echo $_GET['reportid'];?>">
                    <input type="hidden" name="form_type" id="form_type" value="Customization">
                    <input type="hidden" name="category" id="category" value="<?php echo $category_detail['catName'];?>">
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
                     
                    <div class="form-group radio-btn d-none">
                        <label>Select your budget</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="budget_1" value="$9000 - $12000" id="budget_value_1">
                          <label class="form-check-label" for="budget_value_1">
                            $9000 - $12000
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="budget_1" value="$13000 - $17000" id="budget_value_2">
                          <label class="form-check-label" for="budget_value_2">
                            $13000 - $17000
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="budget_1" value=" $18000 - More" id="budget_value_3">
                          <label class="form-check-label" for="budget_value_3">
                            $18000 - More
                          </label>
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
            <div class="col-lg-5 col-md-6">
                <div class="space-left ">
                    <h3 class="purple-txt pb-3 mb-0">Quick Contact</h3>
                    <div class="outer-main bg-dark-blue w-75">
                        <a href="tel:+1 804 441 9344">
                            <img src="<?php echo SITEPATH;?>images/Mobile.webp" alt="call" class="img-fluid activity-icon">
                            +1 804 441 9344
                        </a>
                        <a href="tel:+44 7782 560 738">
                            <img src="<?php echo SITEPATH;?>images/call-gr.webp" alt="call" class="img-fluid activity-icon">
                           +44 7782 560 738
                        </a>
                        <a href="mailto:sales@towardshealthacre.com">
                            <img src="<?php echo SITEPATH;?>images/mail-gr.webp" alt="location" class="img-fluid activity-icon">
                            sales@towardshealthacre.com
                        </a>
                    </div>
                    <h3 class="mt-5 purple-txt pb-3 mb-0">Why trust Us?</h3>
                    <div class="bg-dark-blue w-75 cust-slider">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                          </div>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                                <p class="text-white"><strong>5,000+</strong> Research Reports</p>
                            </div>
                            <div class="carousel-item">
                              <p class="text-white">Serving <strong>
                                  500 Fortune Companies
                              </strong>
                                 in 150+ countries
                              </p>
                            </div>
                            <div class="carousel-item">
                                <p class="text-white">
                                    <strong>5 Million+</strong>
                                     Market Data 
                                </p>
                            </div>
                          </div>
                        </div>
                    </div>
                    <h3 class="mt-5 purple-txt pb-3 mb-0">Trusted Partner</h3>
                    <div class="row trusted-partner-img">
                        <div class="col-md-4">
                            <img src="<?php echo SITEPATH;?>images/clients-logo/C_1.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                        <div class="col-md-4">
                             <img src="<?php echo SITEPATH;?>images/clients-logo/C_2.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                        <div class="col-md-4">
                             <img src="<?php echo SITEPATH;?>images/clients-logo/C_3.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo SITEPATH;?>images/clients-logo/C_4.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                        <div class="col-md-4">
                             <img src="<?php echo SITEPATH;?>images/clients-logo/C_5.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                        <div class="col-md-4">
                             <img src="<?php echo SITEPATH;?>images/clients-logo/C_6.png" alt="partner-logo" class="img-fluid"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-pattern">
            <img src="<?php echo SITEPATH;?>images/Form_Pattern_Right.webp" alt="bottom-pattern" class="img-fluid">
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