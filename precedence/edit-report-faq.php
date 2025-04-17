<?php
require_once("classes/cls-report.php");

$obj_report = new Report();


if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $fields="*";
    $report_id = base64_decode($_GET['report_id']);
    $faq_id = base64_decode($_GET['editq']);
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "' and `faq_id` = '" . base64_decode($_GET['editq']) ."'";
    $report_faq_details = $obj_report->getReportFAQNewDetails('', $condition, '', '', 0);
    $report_faq_detail = end($report_faq_details);
    
}

?>
<style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  margin-right: 0.5rem;
}

</style>
<?php include('header.php')?>

<?php include('sidebar-menu.php')?>
   <div class="home-section">
        <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
            <!-- Page Content -->
           
         <div>
             <img src="images/Top.svg" class="img-fluid top-right-pattern">
         </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row d-flex align-items-center pb-3 light-bg">
                    <div class="col-lg-7">
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i>Edit FAQ</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>view-report-faq?report_id=<?php echo $_GET['report_id'];?>" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                
                
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-8 offset-lg-2 ft-size">
                        <div class="panel panel-default">
                          <!--  <div class="panel-heading">
                                General User Form
                            </div>-->
                            <div class="shadow-lg add-card bg-white mt-3 mb-3">
                                <!-- /.panel-heading -->
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>edit-report-faq-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="category-form" id="category-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo $report_id;?>">
                                        <input type="hidden" name="editq" id="editq" value="<?php echo $faq_id;?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                        <!-- / hidden fields -->
                                        <div class="form-group">
                                            <label>Question <span class="error">*</span></label>
                                            <input type="text" name="question" id="question" placeholder="Enter Question" class="form-control" value="<?php echo (isset($report_faq_detail['question'])) ? $report_faq_detail['question'] : ""; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Answer <span class="error">*</span></label>
                                            <textarea rows="3" name="answer" id="answer" placeholder="Enter Answer" class="form-control" style="height:74px;"><?php echo (isset($report_faq_detail['answer'])) ? $report_faq_detail['answer'] : "";?></textarea>
                                        </div>
                                        
                                        
                                       
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_lead_submit" name="btn_lead_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
       <div>
             <img src="images/Bottom.svg" class="img-fluid bottom-left-pattern">
         </div>
       </section>
   </div>

 
   
 <?php include("footer.php"); ?>

<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo SITEADMIN; ?>js/faq.js"></script>
<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});

</script>