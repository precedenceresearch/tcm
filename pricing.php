<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$reportid=$_GET['reportid'];
$fields_report="report_id,Price_SUL,Price_CUL,CatId,Price_Multi,slug,meta_title,meta_description,meta_keywords";
$condition_report="`predr_reports`.`report_id`='".$reportid."'";
$report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
$report_detail_specific=end($report_detail_specifics);

$fields_category = "catId,catName,slug";
$condition_category="`predr_category`.`catId`='".$report_detail_specific['CatId']."'";
$category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);
$category_detail=end($category_details);

    $fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);

$page = "pricing"; 
$meta_title="Price - Towards Packaging";
$meta_keyword="Towards Packaging, Business Consulting, Packaging Consulting, Intelligence Centers, Company Analytics";
$meta_description="Towards Packaging is a full-service Packaging consulting firm dedicated to the provision of business intelligence for medical device, biologics, dental, and pharmaceutical industries.";
$noindex="noindex";
?>
<?php include("header.php")?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/common.css"> 
<div class="gradient-bg ptb pricing-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!--<p class="mb-0">SINGLE SEAT SOLUTIONS FOR INDIVIDUALS AND SMALL BUSINESSES</p>-->
                <h1 class="ttl mb-0 text-white">Select a license type that suits your business needs</h1>
            </div>
        </div>
    </div>
</div>
<div class="mt-7">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-4 d-flex">
                        <div class="price-holder">
                            <h3 class="text-center mb-0">Single User</h3>
                            <h5 class="text-center mb-0">$<?php echo $report_detail_specific['Price_SUL'];?></h5>
                            <ul class="pricing-list list-unstyled">
                                <li>Restricted to one authorized user</li>
                                <li>One print only</li>
                                <li>Available in PDF</li>
                                <li class="ban-icon">Free industry update (Within 180 days) </li>
                                <li class="ban-icon">Free report update in next update cycle  (Sep 2023 - Sep 2024) </li>
                            </ul>
                            <div class="text-center">
                                <button type="button" onclick="openModal(<?php echo $report_detail_specific['Price_SUL']; ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="ord-3" class="btn purple-btn">Order Now</button>
                            </div>
                        </div>
                     </div>
                    <div class="col-md-4 d-flex">
                        <div class="price-holder">
                            <h3 class="text-center mb-0">Multi Users</h3>
                            <h5 class="text-center mb-0">$<?php echo $report_detail_specific['Price_Multi'];?></h5>
                            <ul class="pricing-list list-unstyled">
                                <li>Limited to five authorized users</li>
                                <li>Print upto five copies</li>
                                <li>Available in PDF</li>
                                <li class="ban-icon">Free industry update (Within 180 days) </li>
                                <li class="ban-icon">Free report update in next update cycle  (Sep 2023 - Sep 2024) </li>
                            </ul>
                            <div class="text-center">
                                <button type="button" onclick="openModal(<?php echo $report_detail_specific['Price_Multi']; ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="ord-3" class="btn purple-btn">Order Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex">
                        <div class="price-holder">
                            <h3 class="text-center mb-0">Enterprise License</h3>
                            <h5 class="text-center mb-0">$<?php echo $report_detail_specific['Price_CUL'];?></h5>
                            <ul class="pricing-list list-unstyled">
                                <li>Unlimited within company/enterprise</li>
                                <li>Available in Excel & PDF</li>
                                <li>Free industry update (Within 180 days)</li>
                                <li>Free report update in next update cycle (Sep 2023 - Sep 2024)</li>
                                <li>We offer 100% free customisation with our Enterprise License!</li>
                            </ul>
                            <div class="text-center">
                                <!--<button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="ord-3" class="btn purple-btn">Order Now</button>-->
                                <button type="button" onclick="openModal(<?php echo $report_detail_specific['Price_CUL']; ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="ord-3" class="btn purple-btn">Order Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container pt-5">
    <div class="row clients-logo">
        <div class="col-md-12">
            <h3 class="ttl-2 text-center">Leading companies trust Towards Packaging</h3>
        </div>
        <div class="col-lg-2 col-md-4">
            <img src="<?php echo SITEPATH;?>images/clients-logo/C_1.png" alt="partner-logo" class="img-fluid"> 
        </div>
        <div class="col-lg-2 col-md-4">
             <img src="<?php echo SITEPATH;?>images/clients-logo/C_2.png" alt="partner-logo" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-4">
            <img src="<?php echo SITEPATH;?>images/clients-logo/C_3.png" alt="partner-logo" class="img-fluid"> 
        </div>
        <div class="col-lg-2 col-md-4">
              <img src="<?php echo SITEPATH;?>images/clients-logo/C_4.png" alt="partner-logo" class="img-fluid">
        </div>
        <div class="col-lg-2 col-md-4">
           <img src="<?php echo SITEPATH;?>images/clients-logo/C_5.png" alt="partner-logo" class="img-fluid"> 
        </div>
        <div class="col-lg-2 col-md-4">
            <img src="<?php echo SITEPATH;?>images/clients-logo/C_6.png" alt="partner-logo" class="img-fluid"> 
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center ttl-2 mb-0 pb-4">Benefits of our business solutions</h2>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-lg-3 col-md-6">
            <div class="benefit-holder border-left-dashed">
                <div class="icon-holder">
                    <img src="<?php echo SITEPATH;?>images/pricing-page/pricing-1.png" alt="Industrial Experience" class="img-fluid">
                </div>
                <div class="benefits-data">
                    <h4>Industrial Experience</h4>
                    <p class="para">In terms of providing trustworthy market, business, and consumer data, we are the industry leader.
                    The best quality of our products and publications is guaranteed by more than 500 data professionals.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="benefit-holder">
                <div class="icon-holder">
                    <img src="<?php echo SITEPATH;?>images/pricing-page/pricing-2.png" alt="Publication Rights" class="img-fluid">
                </div>
                <div class="benefits-data">
                    <h4>Publication Rights</h4>
                    <p class="para">Get a full onboarding service and 
                    timely assistance from your dedicated contact person. We help 
                    you to make the most out of your 
                    research</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="benefit-holder">
                <div class="icon-holder">
                    <img src="<?php echo SITEPATH;?>images/pricing-page/pricing-3.png" alt="Credible Sources" class="img-fluid">
                </div>
                <div class="benefits-data">
                    <h4>Credible Sources</h4>
                    <p class="para">You get access to content from more than 22,500 reputable sources as well to exclusive data from Towards Packaging, which includes helpful additional details.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="benefit-holder">
                <div class="icon-holder">
                    <img src="<?php echo SITEPATH;?>images/pricing-page/pricing-4.png" alt="Time-saving analysis" class="img-fluid">
                </div>
                <div class="benefits-data">
                    <h4>Time-saving analysis</h4>
                    <p class="para">To increase the effectiveness of your research: multiple download options and intelligence search (XLS and PDF format).</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="ptb pt-0">
    <div class="container why-choose-txt">
        <div class="row">
            <div class="col-md-12">
                <p class="para text-center mb-0">Towards Packaging By The Numbers</p>
                <h4 class="ttl-2 text-center">Key figures at a glance</h4>
            </div>
        </div>
        <div class="row purple-bg p-4 border-radius-top">
            <div class="col-md-12 text-center">
                <h3 class="ttl-2 mb-0 text-white pb-4">Why Choose Us</h3>
            </div>
            <div class="col text-center">
                <h5 class="mb-0">500,000<sup>+</sup></h5>
                <span>Company database</span>
            </div>
            <div class="col text-center">
                <h5 class="mb-0">98<sup>%</sup></h5>
                <span>Repeat Clients</span>
            </div>
            <div class="col text-center">
                <h5 class="mb-0">30<sup>+</sup></h5>
                <span>Annual subscriptions</span>
            </div> 
            <div class="col text-center">
                <h5 class="mb-0">100<sup>+</sup></h5>
                <span>Prime clients</span>
            </div>
            <div class="col text-center">
                <h5 class="mb-0">600<sup>+</sup>hours</h5>
                <span>KOL Interviews</span>
            </div>
        </div>
    </div>
</div>
<div class="container ptb pt-0">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="green-bg p-5 text-center">
                <h3 class="text-white ttl-2 mb-0">Talk To Our Expert</h3>
                <p class="para text-white">When you describe your problems to us, our experts will assist you in determining how to use the Towards Packaging 
                platform to address them in the most effective way. You can contact our Services experts using the form below. Our team will assist you when 
                you provide details about your inquiry.</p>
                <a href="<?php echo SITEPATH."customization/".$reportid;?>" class="btn purple-btn bg-white text-dark">Get in touch
                    <img src="https://www.towardspackaging.com/images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                </a>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php")?>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered checkout-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Checkout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="request-form" novalidate method="POST" action="<?php echo SITEPATH;?>payment-action.php">
             <input type="hidden" name="report_id" id="report_id" value="<?php echo $_GET['reportid'];?>">
             <input type="hidden" name="form_type" id="form_type" value="Buy Now">
             <input type="hidden" name="category" id="category" value="<?php echo $category_detail['catName'];?>">
             <input type="hidden" name="payment_amount" id="payment_amount" value="">
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
                
                <div class="text-center">
                    <button type="submit" class="btn purple-btn">Buy Now
                        <img src="<?php echo SITEPATH; ?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

<script>
    function openModal(price) {
        // Set the price value to the modal input field or any other element
        document.getElementById('payment_amount').value = price;

        // Open the modal
        $('#staticBackdrop').modal('show');
    }
</script>


<script>
$(document).ready(function(e){
    e.preventDefault();
    document.getElementById('ord-1').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
    });

    document.getElementById('ord-2').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
    });

    document.getElementById('ord-3').addEventListener('click', function () {
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        myModal.show();
    });
    });
</script>