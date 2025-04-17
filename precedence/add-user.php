<?php
require_once("classes/cls-admin.php");
require_once("classes/cls-menu.php");
$obj_admin = new Admin();
$obj_menu = new Menu();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location: login.php");
    exit; // Always use exit() after header redirects
}
if (isset($_GET['admin_id']) && $_GET['admin_id'] != "") {
    $user_id = base64_decode($_GET['admin_id']);
    $condition = "`admin_id` = '" . base64_decode($_GET['admin_id']) . "'";
    $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
    $admin_detail_user = end($admin_details);
}
else {
    $admin_detail_user['status'] = ""; 
    
}

$fields = "*";
$condition = "status = 'Active' AND (parent_menu_id='' OR parent_menu_id IS NULL)";
$menu_details_add = $obj_menu->getMenuDetails($fields, $condition, '', '', 0);
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> User</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-user" class="btn s-btn float-end">
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
                                <form role="form" method="POST" action="add-admin-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="add-form" id="add-form">
                                                <!-- hidden fields -->
                                                <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['admin_id'])) ? "edit" : "add"; ?>">
                                                <input type="hidden" name="admin_id" id="admin_id" value="<?php echo (isset($_GET['admin_id'])) ? $_GET['admin_id'] : ""; ?>">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                <!-- / hidden fields -->
                                                <div class="form-group">
                                                    <label>First Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo (isset($admin_detail_user['f_name'])) ? $admin_detail_user['f_name'] : ""; ?>">
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Last Name <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo (isset($admin_detail_user['lname'])) ? $admin_detail_user['lname'] : ""; ?>">
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email Id <span class="error">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="<?php echo (isset($admin_detail_user['email_id'])) ? $admin_detail_user['email_id'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['admin_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_email" id="old_email" value="<?php echo (isset($admin_detail_user['email_id'])) ? $admin_detail_user['email_id'] : ""; ?>">
                                                <?php } ?>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Username <span class="error">*</span></label>
                                                    <input type="text" class="form-control" name="uname" id="uname" placeholder="Username" value="<?php echo (isset($admin_detail_user['uname'])) ? $admin_detail_user['uname'] : ""; ?>">
                                                </div>
                                                <?php if (isset($_GET['admin_id'])) { ?>
                                                    <input type="hidden" class="form-control" name="old_uname" id="old_uname" value="<?php echo (isset($admin_detail_user['uname'])) ? $admin_detail_user['uname'] : ""; ?>">
                                                <?php } ?>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo (isset($admin_detail_user['password'])) ? base64_decode($admin_detail_user['password']) : ""; ?>">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password" id="eye"></span>
                                                </div>
                                                
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Confirm Password <span class="error">*</span></label>
                                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                                </div>
                                        </div>   
                                        <div class="col-lg-6">
                                                 <div class="form-group">
                                                    <label>Role <span class="error">*</span></label>
                                                    <select name="role" id="role" class="form-select h-50" aria-label="User Role">
                                                        <option value="">Select Role</option>
                                                        <option value="admin" <?php if(isset($admin_detail_user['role'])){if($admin_detail_user['role']=="admin"){?> selected <?php } }?>>Admin</option>
                                                        <option value="research" <?php if(isset($admin_detail_user['role'])){if($admin_detail_user['role']=="research"){?> selected <?php } }?>>Research</option>
                                                        <option value="sales" <?php if(isset($admin_detail_user['role'])){if($admin_detail_user['role']=="sales"){?> selected <?php } }?>>Sales</option>
                                                        <option value="marketing" <?php if(isset($admin_detail_user['role'])){if($admin_detail_user['role']=="marketing"){?> selected <?php } }?>>Marketing</option>
                                                    </select>
                                                </div>
                                        </div>
                                     
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($admin_detail_user['status']) && $admin_detail_user['status'] == 'Active'|| $admin_detail_user['status'] == '' ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($admin_detail_user['status']) && $admin_detail_user['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>
                                        </div>
                                            <?php 
                                                if (isset($_GET['admin_id']) && $_GET['admin_id'] != "") 
                                                {
                                                    $menupids=explode(",",$admin_detail_user['menu_id']);
                                                }
                                            ?>
                                            <div class="col-lg-12">
                                                   <div class="form-group">
                                                    <label>Menu Access <span class="error">*</span></label>
                                                    <?php if(isset($menu_details_add) && !empty($menu_details_add)) { ?>
                                                     <select class="form-control form-select" name="menu_list[]" id="menu_list" multiple multiselect-search="true" multiselect-select-all="true" onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))" multiselect-hide-x="true">
                                                            <?php foreach ($menu_details_add as $menu_detail_add) { ?>
                                                                <option value="<?php echo $menu_detail_add['menu_id']; ?>" <?php if (isset($_GET['admin_id']) && $_GET['admin_id'] != "") { if(in_array($menu_detail_add['menu_id'], $menupids)) {?> selected <?php }}?> ><?php echo $menu_detail_add['menu_name'] ?></option>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <option value="">No Menu Found</option>
                                                        <?php } ?>
                                                        </select>
                                                </div>
                                             </div>
                                       
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_lead_submit" name="btn_lead_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                            <span id="loading-image" style="display:none;"><img src="<?php echo SITEADMIN;?>images/loading.gif" height="40" width="40"></span>
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
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script src="<?php echo SITEADMIN; ?>js/multiselect-dropdown.js" ></script>
   <script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
    <script src="<?php echo SITEADMIN; ?>js/add-admin.js"></script>
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

 $(function(){
  $('#eye').click(function(){
      
        if($(this).hasClass('fa-eye')){
           
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');
          
          $('#password').attr('type','password');
            
        }else{
         
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');  
          
          $('#password').attr('type','text');
        }
    });
    
    // $("#reset").click(function(){
    //     $("#uname").val("");
    // });
 });
    
</script>