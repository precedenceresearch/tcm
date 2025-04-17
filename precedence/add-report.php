<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
require_once("classes/cls-author.php");

$obj_author = new Author();
$obj_report = new Report();
$obj_category = new Category();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $report_id = base64_decode($_GET['report_id']);
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $report_details = $obj_report->getReportDetails('', $condition, '', '', 0);
    $report_details_specific = end($report_details);
}
else {
    $report_details_specific['status'] = ""; 
    //$report_details_specific['popular'] = "";
    $report_details_specific['CatId'] = "";
    $report_details_specific['author_id'] = "";
}
$fields = "catName,catId";
$condition = "`predr_category`.`status`='Active'";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '','', 0);

$fields_author="author_id,author_name";
$condition_author="`predr_author`.`status`='Active'";
$author_details=$obj_author->getAuthorDetails($fields_author, $condition_author, '', '', 0);
?>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>
<style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  margin-right: 0.5rem;
}
.tox-editor-header{
    z-index: auto !important;
}
.shortDescription{
    visibility:visible !important;
        font-size: .9rem !important;
}
.tox-promotion{display:none !important;}
</style>

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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</h5>
                    </div>
                    <?php if (isset($_GET['report_id']) && $_GET['report_id'] != "") {?>
                     <div class="col-md-3">
                         <!--<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn s-btn float-end">-->
                         <!--    View Graphs</a>-->
                         <a href="graph-list.php?report_id=<?php echo $_GET['report_id'];?>" target="_blank" class="btn s-btn float-end">
                             View Graphs</a>
                    </div>
                    <div class="col-md-2">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php } else {?>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php }?>
                </div>
                
                
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-10 offset-lg-1 ft-size">
                        <div class="panel panel-default">
                          <!--  <div class="panel-heading">
                                General User Form
                            </div>-->
                            <div class="shadow-lg add-card bg-white mt-3 mb-3">
                                <!-- /.panel-heading -->
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>add-report-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="report-form" id="report-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['report_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? $_GET['report_id'] : ""; ?>">
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report Title <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="reptitle" id="reptitle" placeholder="Report Title" value="<?php echo (isset($report_details_specific['reportSubject'])) ? $report_details_specific['reportSubject'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report URL Keyword <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="repurl" id="repurl" placeholder="Report URL Keyword" value="<?php echo (isset($report_details_specific['slug'])) ? $report_details_specific['slug'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Category <span class="error">*</span></label>
                                                <select class="form-select" aria-label="Default select example" name="repcategory" id="repcategory" style="line-height:1.9;">
                                                  <option value="">Select Category</option>
                                                  <?php foreach($category_details as $category_detail){?>
                                                   <option value="<?php echo $category_detail['catId']; ?>" <?php if($category_detail['catId']==$report_details_specific['CatId']){?> selected <?php }?>><?php echo $category_detail['catName']; ?></option>
                                                  <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Publish Date <span class="error">*</span></label>
                                                <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="pubdate" id="pubdate" value="<?php echo (isset($report_details_specific['reportDate'])) ? $report_details_specific['reportDate'] : ""; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Short Description </label>
                                             <textarea rows="3" class="form-control shortDescription tinytextarea" name="shortDescription" id="shortDescription" style="visibility: visible !important;"><?php echo (isset($report_details_specific['shortDescription'])) ? stripslashes($report_details_specific['shortDescription']) : ""; ?></textarea>
                                             <!--<textarea class="form-control tinytextarea" name="description" id="description" placeholder="Description"></textarea>-->
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Description </label>
                                             <textarea rows="7" class="form-control tinytextarea" name="description" id="description"><?php echo (isset($report_details_specific['reportLDesc'])) ? stripslashes($report_details_specific['reportLDesc']) : ""; ?></textarea>
                                             <!--<textarea class="form-control tinytextarea" name="description" id="description" placeholder="Description"></textarea>-->
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Table of Content </label>
                                            <textarea class="form-control" name="toc" id="toc" placeholder="Table of Content"><?php echo (isset($report_details_specific['toc'])) ? $report_details_specific['toc'] : ""; ?></textarea>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Experts Opinion</label>
                                            <textarea class="form-control" rows="7" name="experts_opinion" id="experts_opinion" placeholder="Experts Opinion"><?php echo (isset($report_details_specific['experts_opinion'])) ? $report_details_specific['experts_opinion'] : ""; ?></textarea>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>References </label>
                                            <textarea class="form-control" rows="7" name="references" id="references" placeholder="References"><?php echo (isset($report_details_specific['references'])) ? $report_details_specific['references'] : ""; ?></textarea>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Single License</label>
                                                <input type="text" class="form-control" placeholder="Single License" name="singlicense" id="singlicense" value="<?php echo (isset($report_details_specific['Price_SUL'])) ? $report_details_specific['Price_SUL'] : ""; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Multi License</label>
                                                <input type="text" class="form-control" placeholder="Multi License" name="multilicense" id="multilicense" value="<?php echo (isset($report_details_specific['Price_Multi'])) ? $report_details_specific['Price_Multi'] : ""; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Corporate License</label>
                                                <input type="text" class="form-control" placeholder="Corporate License" name="corplicense" id="corplicense" value="<?php echo (isset($report_details_specific['Price_CUL'])) ? $report_details_specific['Price_CUL'] : ""; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>No. of Pages</label>
                                                <input type="text" class="form-control" placeholder="No. of Pages" name="pages" id="pages" value="<?php echo (isset($report_details_specific['No_Pages'])) ? $report_details_specific['No_Pages'] : ""; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Title <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="metatitle" id="metatitle" placeholder="Meta Title" value="<?php echo (isset($report_details_specific['meta_title'])) ? $report_details_specific['meta_title'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Meta Description </label>
                                            <input type="text" class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description" value="<?php echo (isset($report_details_specific['meta_description'])) ? $report_details_specific['meta_description'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Keyword </label>
                                             <input type="text" class="form-control" name="metakeyword" id="metakeyword" placeholder="Meta Keyword" value="<?php echo (isset($report_details_specific['meta_keywords'])) ? $report_details_specific['meta_keywords'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Author</label>
                                                <select class="form-select" aria-label="Default select example" name="repauthor" id="repauthor" style="line-height:1.9;">
                                                  <option value="">Select Author</option>
                                                  <?php foreach($author_details as $author_detail){?>
                                                   <option value="<?php echo $author_detail['author_id']; ?>" <?php if($author_detail['author_id']==$report_details_specific['author_id']){?> selected <?php }?>><?php echo $author_detail['author_name']; ?></option>
                                                  <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 pt-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="feature" id="feature" value="1" <?php echo (isset($report_details_specific['featured']) && $report_details_specific['featured'] == '1') ? "checked" : ""; ?>>
                                                <label for="feature">Is Featured</label> 
                                            </div>
                                        </div>
                                        <div class="col-lg-10  pt-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="popular" id="popular" value="1" <?php echo (isset($report_details_specific['popular']) && $report_details_specific['popular'] == '1') ? "checked" : ""; ?>>
                                                <label for="popular">Is Popular</label> 
                                            </div>
                                        </div>
                                        <div class="col-lg-10  pt-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="footerreport" id="footerreport" value="1" <?php echo (isset($report_details_specific['footerreport']) && $report_details_specific['footerreport'] == '1') ? "checked" : ""; ?>>
                                                <label for="footerreport">Is Top Selling Report</label> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($report_details_specific['status']) && $report_details_specific['status'] == 'Active'|| $report_details_specific['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($report_details_specific['status']) && $report_details_specific['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">View Graphs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <?php include("graph-list.php");?>
      </div>
      
    </div>
  </div>
</div>
<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo SITEADMIN; ?>js/add-report.js"></script>

<script src="https://cdn.tiny.cloud/1/rq21nep9x685euodgqcz9zazuspsjti0u00fr60g5c5rlp6b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/skins/ui/oxide/content.min.css" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: "textarea",
    plugins: 'advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak table paragraphgroup code',
    toolbar: 'undo redo | h1 h2 h3 h4 h5 h6 | styleselect | forecolor | bold italic | paragraphgroup | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | numlist bullist table ',
    skin: 'outside',
    forced_root_block : 'p',
	image_title: true
});
  </script>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
// <script>
// $(document).ready(function(){
  
//   $(function () {
// 	$('#pubdate').datepicker({
//   format: 'yyyy-mm-dd' 
//   });
//   });
	
  
// });
// </script>
</body>
</html>