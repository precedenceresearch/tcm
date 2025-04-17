<?php
require_once("classes/cls-author.php");

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$obj_author = new Author();

if (isset($_GET['author_id']) && $_GET['author_id'] != "") {
    $auth_id = base64_decode($_GET['author_id']);
    $condition = "`author_id` = '" . base64_decode($_GET['author_id']) . "'";
    $author_details = $obj_author->getAuthorDetails('', $condition, '', '', 0);
    $author_detail_user = end($author_details);
}
else {
    $author_detail_user['status'] = ""; 
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['author_id'])) ? "Edit" : "Add"; ?> Author</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-author" class="btn s-btn float-end">
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>add-author-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="category-form" id="category-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['author_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="author_id" id="author_id" value="<?php echo (isset($_GET['author_id'])) ? $_GET['author_id'] : ""; ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                        <!-- / hidden fields -->
                                        <div class="form-group">
                                            <label>Full Name <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Full Name" value="<?php echo (isset($author_detail_user['author_name'])) ? $author_detail_user['author_name'] : ""; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Email <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo (isset($author_detail_user['author_email'])) ? $author_detail_user['author_email'] : ""; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Designation <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="desig" id="desig" placeholder="Designation" value="<?php echo (isset($author_detail_user['author_designation'])) ? $author_detail_user['author_designation'] : ""; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Description <span class="error">*</span></label>
                                            <textarea class="form-control" name="descp" id="descp" placeholder="Description"><?php echo (isset($author_detail_user['author_description'])) ? $author_detail_user['author_description'] : ""; ?></textarea>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($author_detail_user['status']) && $author_detail_user['status'] == 'Active'|| $author_detail_user['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($author_detail_user['status']) && $author_detail_user['status'] == 'Inactive') ? "checked" : ""; ?>>
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
    <script src="<?php echo SITEADMIN; ?>js/author.js"></script>
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