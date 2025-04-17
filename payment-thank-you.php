<?php
require_once("precedence/classes/cls-connection.php");
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");

$obj_lead = new Lead();
$obj_report = new Report();
$page = "thank-you"; 
$meta_title="Towards Packaging - Packaging Knowledge Services";
$meta_keyword="";
$meta_description="";
$noindex="noindex";
//$form_name = $_GET['form_name'];

$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);

$fields="*";
$condition="`predr_formdetails`.`transaction_id`='".$_GET['transaction_id']."'";
$lead_details=$obj_lead->getLeadDetails($fields,$condition,'','',0);
$lead_details = end($lead_details);


if(empty($lead_details)){
    header('Location: '.SITEPATH);
    die();
    }

$fieldss="`report_id`,`meta_title`";
$conditions="`report_id`=".$lead_details['report_id']."";
$lead_detailss=$obj_report->getReportDetails($fieldss,$conditions,'','',0);
$lead_detailss = end($lead_detailss);

?>
<?php include('header.php')?>
<div class="success-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="success-holder-main purple-bg justify-content-center">
                     <img src="<?php echo SITEPATH;?>images/home-page/Thank-you-icon.webp" alt="thank-you-icon" class="tick-icon img-fluid">
                     <div class="ps-4">
                          <h1 class="mb-0 pb-5 text-white" style="display: contents;">Payment Successful</h1>
                     </div>
                </div>
                <div class="bx-shadow s-content">
                        <p class="para mb-0">Your Payment has been Successfully Processed. Thank you for
                            choosing Towardspackaging! We appreciate your trust in us and hope
                            you’re satisfied with your purchase.</p>
                      
                   <p class="ttl-up space-bottom-8"><strong class="fw-bold">Transaction Details:</strong></p>
                        <p class="para pb-3">
                            <strong class="fw-bold">Transaction ID:</strong> <?php echo $lead_details['transaction_id']; ?>
                        </p>
                        <p class="para pb-3">
                            <strong class="fw-bold">Payment Amount:</strong> USD <?php echo $lead_details['price']; ?>
                        </p>
                        <p class="para pb-3">
                            <strong class="fw-bold">Date & Time:</strong> <?php echo $lead_details['createddate']; ?>
                        </p>
                        <?php if($lead_details['formname']=="Buy Now"){ ?>
                            <p class="para pb-3">
                                <strong class="fw-bold">Product/Service Purchased:</strong> <?php echo $lead_detailss['meta_title']; ?>
                            </p>
                        <?php } ?>    
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php')?>