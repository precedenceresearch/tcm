<?php
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");

$obj_report = new Report();
$obj_lead = new Lead();

$conn = $obj_lead->getConnectionObj();


$reportid=$_GET['reportid'];
$fields_report="report_id,CatId,reportSubject,reportLDesc,toc,Price_SUL,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords";
$condition_report="`predr_reports`.`report_id`='".$reportid."'";
$report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
$report_detail_specific=end($report_detail_specifics);

$leadid=$_GET['leadid'];
$update_data['payment_status'] = "Failed";
$condition = "`predr_formdetails`.`id` = '" . $leadid . "'";
$obj_lead->updateLead($update_data, $condition);

$page = "thank-you"; 
$meta_title="Payment Failed - Towards Healthcare";
$meta_keyword="Towards healthcare, Business Consulting, Healthcare Consulting, Intelligence Centers, Company Analytics";
$meta_description="Towards Healthcare is a full-service healthcare consulting firm dedicated to the provision of business intelligence for medical device, biologics, dental, and pharmaceutical industries.";

?>
<?php include('header.php')?>
<div class="success-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="success-holder-main purple-bg">
                    <img src="<?php echo SITEPATH;?>images/home-page/Fail-Icon.png" alt="fail" class="img-fluid">
                    <div class="ps-4">
                        <h1 class="text-white mb-0">Payment Failed !</h1>
                        <p class="text-white para">We’re sorry to inform you that your payment
                        method was declined</p>
                    </div>
                </div>
                <div class="bx-shadow s-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">No worries, It Happens sometimes. The Most common reasons are:</h4>
                            <ul class="payment-failed">
                                <li>Insufficient Credit card</li>
                                <li>Expired credit card</li>
                                <li>The Banks fraud rules blocked the transaction</li>
                            </ul>
                        </div>
                        <div class="col-md-8 offset-md-2 border-top-dashed text-center">
                            <h3 class="mb-0 pt-4">If you need assistance or have any questions,
                                please feel free to reach out to us any time</h3>
                            <a href="<?php echo SITEPATH;?>contact-us" class="btn green-btn">Connect with us
                                <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php')?>