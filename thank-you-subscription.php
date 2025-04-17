<?php
include("precedence/classes/cls-connection.php");
require_once("precedence/classes/cls-report.php");
$obj_report = new Report();
$page = "thank-you"; 
$meta_title="Thanks - Towards Packaging";
$meta_keyword="";
$meta_description="";
$noindex="noindex";
//$form_name = $_GET['form_name'];
if(isset($_GET['reportid'])){
$report_id = $_GET['reportid'];
if($report_id!=""){
    $fields_report="report_id,CatId,reportSubject,reportLDesc,toc,Price_SUL,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords,author_id";
    $condition_report="`predr_reports`.`report_id`='".$report_id."'";
    $report_detail_specifics=$obj_report->getReportDetailsthanks($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);
}
    
}
?>
<?php include('header.php')?>
<div class="success-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="success-holder-main yl-bg justify-content-center">
                     <img src="<?php echo SITEPATH;?>images/Thank-you-icon.webp" alt="thank-you-icon" class="tick-icon img-fluid">
                     <div class="ps-4">
                          <h1 class="mb-0 text-white">Thank You</h1>
                     </div>
                </div>
                <div class="bx-shadow s-content">
                    <?php if(isset($_GET['reportid'])){ ?>   <p class="para mb-0">We have received your request for the insight of <a href="<?php echo SITEPATH.'insights/'.$report_detail_specific['slug'];?>" style="color: #d67e09;"><?php echo $report_detail_specific['reportSubject']; ?></a></p> <?php } ?>
                        <p class="para mb-0">Thanks for contacting Towards Packaging. Our sales team will share brochure with you as soon as possible.</p>
                        <p class="para mb-0">If you have any questions or urgent requirements, please do not hesitate to contact us - <a href="mailto:<?php echo SITEEMAIL; ?>"><?php echo SITEEMAIL; ?></a></p>
                   
                    <div class="text-center">
                        <a href="<?php echo SITEPATH ?>contact-us" class="btn blck-btn mt-5">
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