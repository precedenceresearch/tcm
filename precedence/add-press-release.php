<?php
require_once("classes/cls-press-release.php");

$obj_press = new Press();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if (isset($_GET['press_id']) && $_GET['press_id'] != "") {
    $press_id = base64_decode($_GET['press_id']);
    $condition = "`id` = '" . base64_decode($_GET['press_id']) . "'";
    $press_details = $obj_press->getPressDetails('', $condition, '', '', 0);
    $press_details_specific = end($press_details);
}
else {
    $press_details_specific['status'] = ""; 
    
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['press_id'])) ? "Edit" : "Add"; ?> Press Release</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-press-release" class="btn s-btn float-end">
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>add-press-release-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="press-form" id="press-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['press_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="press_id" id="press_id" value="<?php echo (isset($_GET['press_id'])) ? $_GET['press_id'] : ""; ?>">
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Press Release Title <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="presstitle" id="presstitle" placeholder="Press Release Title" value="<?php echo (isset($press_details_specific['title'])) ? $press_details_specific['title'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Press Release URL Keyword <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="pressurl" id="pressurl" placeholder="Press Release URL Keyword" value="<?php echo (isset($press_details_specific['slug'])) ? $press_details_specific['slug'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Publish Date <span class="error">*</span></label>
                                                <input readonly type="text" class="form-control" placeholder="YYYY-MM-DD" name="pubdate" id="pubdate" value="<?php echo (isset($press_details_specific['pub_date'])) ? $press_details_specific['pub_date'] : ""; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Description </label>
                                             <textarea class="form-control tinytextarea" name="description" id="description" placeholder="Description"><?php echo (isset($press_details_specific['view_desc'])) ? $press_details_specific['view_desc'] : ""; ?></textarea>
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Title </label>
                                             <input type="text" class="form-control" name="metatitle" id="metatitle" placeholder="Meta Title" value="<?php echo (isset($press_details_specific['prmetatitle'])) ? $press_details_specific['prmetatitle'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Meta Description </label>
                                            <input type="text" class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description" value="<?php echo (isset($press_details_specific['prmetadesc'])) ? $press_details_specific['prmetadesc'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Keyword </label>
                                             <input type="text" class="form-control" name="metakeyword" id="metakeyword" placeholder="Meta Keyword" value="<?php echo (isset($press_details_specific['prmetakeywords'])) ? $press_details_specific['prmetakeywords'] : ""; ?>">
                                        </div>
                                        </div>
                                        	
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($press_details_specific['status']) && $press_details_specific['status'] == 'Active'|| $press_details_specific['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($press_details_specific['status']) && $press_details_specific['status'] == 'Inactive') ? "checked" : ""; ?>>
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

<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo SITEADMIN; ?>js/add-press-release.js"></script>
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
<script>
$(document).ready(function(){
  
  $(function () {
	$('#pubdate').datepicker({
   format: 'yyyy-mm-dd' 
  });
  });
	
  
});
</script>