<?php
require_once("classes/cls-category.php");
$obj_category = new Category();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if (isset($_GET['cat_id']) && $_GET['cat_id'] != "") {
    $cat_id = base64_decode($_GET['cat_id']);
    $condition = "`catId` = '" . base64_decode($_GET['cat_id']) . "'";
    $category_details = $obj_category->getCategoryDetails('', $condition, '', '', 0);
    $category_detail_user = end($category_details);
}
else {
    $category_detail_user['status'] = ""; 
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['cat_id'])) ? "Edit" : "Add"; ?> Category</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-category" class="btn s-btn float-end">
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>add-category-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="category-form" id="category-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['cat_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="cat_id" id="cat_id" value="<?php echo (isset($_GET['cat_id'])) ? $_GET['cat_id'] : ""; ?>">
                                        <div class="row">
                                            <div class="col-lg-6">
                                        <!-- / hidden fields -->
                                        <div class="form-group">
                                            <label>Category Title <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="cattitle" id="cattitle" placeholder="Category Title" value="<?php echo (isset($category_detail_user['catName'])) ? $category_detail_user['catName'] : ""; ?>">
                                        </div>
                                        
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($category_detail_user['status']) && $category_detail_user['status'] == 'Active'|| $category_detail_user['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($category_detail_user['status']) && $category_detail_user['status'] == 'Inactive') ? "checked" : ""; ?>>
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
    <script src="<?php echo SITEADMIN; ?>js/category.js"></script>
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