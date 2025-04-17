<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

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

if(isset($_POST['amount']))
{
    $amount=$_POST['amount'];
}
else
{
    $amount=$report_detail_specific['Price_SUL'];
}

$page = "common"; 
$meta_title="Checkout - ".$report_detail_specific['meta_title']."";
$meta_keyword="Towards healthcare, Business Consulting, Healthcare Consulting, Intelligence Centers, Company Analytics";
$meta_description="Towards Healthcare is a full-service healthcare consulting firm dedicated to the provision of business intelligence for medical device, biologics, dental, and pharmaceutical industries.";
$noindex="noindex";
?>
<?php include("header.php")?>
    <div class="container">
        <!--<div class="row">-->
        <!--    <div class="col-md-12">-->
        <!--        <nav aria-label="breadcrumb">-->
        <!--          <ol class="breadcrumb">-->
        <!--            <li class="breadcrumb-item"><a href="#">Home</a></li>-->
        <!--            <li class="breadcrumb-item active" aria-current="page">Buy Now</li>-->
        <!--          </ol>-->
        <!--        </nav>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="row">
            <div class="col-md-12">
                <img src="<?php echo SITEPATH;?>images/home-page/Form_Pattern_Left.png" class="top-pattern" class="img-fluid">
            </div>
        </div>
        <div class="row ptb">
            <div class="col-lg-5 offset-lg-1 col-md-6 pb-5">
                <form class="request-form" novalidate method="POST" action="<?php echo SITEPATH;?>payment-action.php">
                     <input type="hidden" name="report_id" id="report_id" value="<?php echo $_GET['reportid'];?>">
                     <input type="hidden" name="form_type" id="form_type" value="Buy Now">
                     <input type="text" name="company_title" id="company_title" value="<?php if(isset($_POST['company_title']) && !empty($_POST['company_title'])){ echo $_POST['company_title']; }else{ echo ""; } ?>">
                     <input type="hidden" name="category" id="category" value="<?php echo $category_detail['catName'];?>">
                     <input type="hidden" name="payment_amount" id="payment_amount" value="<?php echo $amount;?>">
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
                    <div class="form-group">
                        <label>Address</label>
                        <textarea row="5" col="15" class="form-control" name="address" id="address" required data-error-msg="Write your address"><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                        <div class="invalid-feedback">Address field cannot be blank!</div>
                    </div>
                    <!--<div class="pt-4">-->
                    <!--    <div class="form-check d-flex align-items-center">-->
                    <!--      <input class="form-check-input mt-6" type="checkbox" value="" id="chk_box" required data-error-msg="Please accept terms and conditions">-->
                    <!--      <label class="form-check-label para ps-3" for="chk_box">-->
                    <!--        I have read and agree to the <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal" class="purple-txt">Terms & Conditions</a>-->
                    <!--      </label>-->
                         
                    <!--    </div>-->
                    <!--     <div class="invalid-feedback">Accept terms and conditons!</div>-->
                    <!--</div>-->
                    <div class="d-flex align-items-center">
                        <h4 class="fw-normal mb-0 pt-4 pe-4">Payment Mode:</h4>
                        <div class="p-mode">
                            <!--<div class="form-check">-->
                            <!--  <input class="form-check-input" type="radio" name="paymode" id="paymode1" value="hdfc" checked="">-->
                            <!--  <label class="form-check-label ps-4" for="paymode1">-->
                            <!--    <img src="<?php echo SITEPATH;?>images/HDFC-Bank.png" alt="payment-mode-hdfc" class="img-fluid">-->
                            <!--  </label>-->
                            <!--</div>-->
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="paymode" id="paymode2" value="paypal" checked="">
                              <label class="form-check-label ps-4" for="paymode2">
                               <img src="<?php echo SITEPATH;?>images/Pypal.png" alt="payment-mode-all" class="img-fluid">
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn purple-btn">Buy Now
                            <img src="<?php echo SITEPATH; ?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </button>
                    </div>
                </form>
                
            </div>
            <div class="col-lg-5 col-md-6 space-left">
                <h1 class="purple-txt font-size">Buy Now</h1>
                <p class="para"><span class="fw-bold">Report Title : </span><a class="report-hyper-link" href="<?php echo SITEPATH.'insights/'.$report_detail_specific['slug'];?>"><?php echo $report_detail_specific['meta_title'];?></a>
                </p>
                <p class="para"><span class="fw-bold">Report Format : </span>PPT, PDF, WORD, EXCEL</p>
                <p class="para"><span class="fw-bold">Report Price : </span>$<?php echo $amount;?></p>
                <div class="r-details w-75">
                    <!--<h4 class="text-center mb-0 mt-5">Proceed To Buy</h4>-->
                    <!--<form class="light-bg gray-gradient" action="" method="POST" name="price_form">-->
                    <!--    <div class="d-flex justify-content-between space-top-bottom pt-0 border-bottom-white">-->
                    <!--        <div class="form-check">-->
                    <!--            <input class="form-check-input" type="radio" name="amount" id="amount1" value="4500" checked="">-->
                    <!--            <label class="form-check-label" for="amount1">-->
                    <!--            Single User-->
                    <!--            </label>-->
                    <!--        </div>-->
                    <!--        <span>USD 4500</span>-->
                    <!--    </div>-->
                    <!--    <div class="d-flex justify-content-between space-top-bottom border-bottom-white">-->
                    <!--        <div class="form-check">-->
                    <!--            <input class="form-check-input" type="radio" name="amount" id="amount2" value="7000">-->
                    <!--            <label class="form-check-label" for="amount2">-->
                    <!--                Multiple User-->
                    <!--            </label>-->
                    <!--        </div>-->
                    <!--        <span>USD 7000</span>-->
                    <!--    </div>-->
                    <!--    <div class="d-flex justify-content-between space-top-bottom border-bottom-white">-->
                    <!--        <div class="form-check">-->
                    <!--            <input class="form-check-input" type="radio" name="amount" id="amount3" value="9000">-->
                    <!--            <label class="form-check-label" for="amount3">-->
                    <!--                Corporate License -->
                    <!--            </label>-->
                    <!--        </div>-->
                    <!--        <span>USD 9000</span>-->
                    <!--    </div>-->
                    <!--</form>-->
                    <div class="p-mode">
                        <img src="<?php echo SITEPATH;?>images/Payment-for-PDF.png" alt="payment-mode-hdfc" class="img-fluid">
                    </div>
                    <h3 class="purple-txt pb-3 mb-0 mt-5">Quick Contact</h3>
                    <div class="outer-main bg-dark-blue">
                        <a href="tel:+1 9197 992 333">
                            <img src="<?php echo SITEPATH;?>images/home-page/Mobile.png" alt="call" class="img-fluid activity-icon">
                             +1 9197 992 333
                        </a>
                        <a href="tel:+91 93077 85324">
                            <img src="<?php echo SITEPATH;?>images/home-page/call-gr.png" alt="call" class="img-fluid activity-icon">
                            +91 93077 85324
                        </a>
                        <a href="mailto:sales@towardshealthacre.com">
                            <img src="<?php echo SITEPATH;?>images/home-page/mail-gr.png" alt="location" class="img-fluid activity-icon">
                            sales@towardshealthacre.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-pattern buy-now-pattern">
            <img src="<?php echo SITEPATH;?>images/home-page/Form_Pattern_Right.png" alt="bottom-pattern" class="img-fluid">
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title purple-txt" id="exampleModalLabel" style="font-size:2rem;">Terms & Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <h2>Delivery</h2>
                <p class="para">The report which is published, shall be delivered to you within 2 to 48 hours, of receipt of payment. Physical delivery of the printed 
                of the report shall be couriered within 4 to 5 working days of payment receipt. Any additional customization, modifications to the current scope of 
                the report, or new and fresh requirements shall be delivered within the timelines stated by our analysts.</p>
                <h2>Payment Terms</h2>
                <p class="para">The client is liable to pay the payment in full before getting the delivery of the report or any other customization 
                (unless other payment terms are agreed upon between Towards Healthcare and the client). The client would also be liable to pay for all other 
                related services (stated in the website) and would also be responsible for the payment of related taxes and duties as and when applicable.</p>
                <h2>Accessing Website</h2>
                <p class="para">While accessing this site, you agree to be bound by these web site Terms and Conditions of Use, and you agree to obey the regulations, 
                law and intellectual property rights. If you are not agreeing to any of the mentioned terms, he/she is not allowed/prohibited from using or accessing 
                this website.</p>
                <h3>Revisions and Modifications</h3>
                <p class="para">Towards Healthcare reserves the rights to modify, revise partly or fully the website and its content. It can revise, alter the terms 
                and conditions anytime, without any prior notifications. The updated T&amp;Cs can be read in this particular section of the site.</p>
                <h3>No Warranties and Limited Liabilities</h3>
                <p class="para">The company has provided the Site ‘as is’ and ‘as available’ basis. Towards Healthcare shall not be responsible or liable for any 
                losses or damages (including, but not limited to, incidental, or consequential damages, profits loss or lost data etc.) that anyone may suffer as a 
                result of relying on the Content of our Site, reports, consulting services, or shall any of the other companies in our group</p>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      <!--</div>-->
    </div>
  </div>
</div>
<?php include("footer.php")?>
<style>
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
/*.form-control.is-valid, .was-validated .form-control:valid{*/
/*    border-color:#ced4da!important;*/
/*    background-image:none!important;*/
/*}*/
/*.was-validated .form-select:valid:not([multiple]):not([size]){*/
/*    border-color:#ced4da!important;*/
   
/*}*/
/*.form-control.is-invalid, .was-validated .form-control:invalid{*/
/*    border-color:#ced4da!important;*/
/*    background-image:none!important;*/
    
/*}*/
/*.was-validated .form-select:invalid:not([multiple]):not([size]){*/
/*    border-color:#ced4da!important;*/
/*}*/
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