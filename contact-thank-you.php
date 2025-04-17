<?php
include("precedence/classes/cls-connection.php");
include("precedence/classes/cls-report.php");

$obj_report = new Report();

$page = "thank-you"; 
$meta_title="Towards Packaging - Packaging Knowledge and Consulting Services";
$meta_keyword="";
$meta_description="Towards Packaging is a full-service packaging consulting firm dedicated to the provision of business intelligence for primary and healthcare packaging, food and beverages, flexible and protective packaging.";
$noindex="noindex";
?>
<?php include('header.php')?>
<div class="success-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="success-holder-main purple-bg justify-content-center">
                     <img src="<?php echo SITEPATH;?>images/home-page/Thank-you-icon.png" alt="thank-you-icon" class="tick-icon img-fluid">
                     <div class="ps-4">
                          <h1 class="mb-0 pb-3 text-white">Thank You</h1>
                     </div>
                </div>
                <div class="bx-shadow s-content">
                    
                        <p class="para  mb-0">Your query has been successfully submitted and our Client Relations Manager will get in touch with you shortly.</p>
                        <p class="para  mb-0">If you have any questions or urgent requirements, please do not hesitate to contact us - <a href="mailto:<?php echo SITEEMAIL; ?>"><?php echo SITEEMAIL; ?></a></p>
                    
                    <div class="text-center">
                        <a href="<?php echo SITEPATH ?>contact-us" class="btn green-btn mt-5">
                            Send Message
                           <img src="<?php echo SITEPATH; ?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php')?>