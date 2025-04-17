<?php
require_once("classes/cls-paylink.php");

$obj_paylink = new Paylink();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if (isset($_GET['pay_id']) && $_GET['pay_id'] != "") {
    $pay_id = base64_decode($_GET['pay_id']);
    $condition = "`payid` = '" . base64_decode($_GET['pay_id']) . "'";
    $pay_details = $obj_paylink->getPaylinkDetails('', $condition, '', '', 0);
    $pay_details_specific = end($pay_details);
}
else {
    $pay_details_specific['currency'] = ""; 
    $pay_details_specific['ltype'] = "";
    
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['pay_id'])) ? "Edit" : "Create"; ?> Paylink</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-paylink" class="btn s-btn float-end">
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>create-paylink-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="paylink-form" id="paylink-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['pay_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="pay_id" id="pay_id" value="<?php echo (isset($_GET['pay_id'])) ? $_GET['pay_id'] : ""; ?>">
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                        <div class="col-lg-12">
                                           <div class="form-group">
                                            <label>Report Code <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="rcode" id="rcode" placeholder="Report Code" value="<?php echo (isset($pay_details_specific['rcode'])) ? $pay_details_specific['rcode'] : ""; ?>">
                                        </div>
                                        </div>
                            
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report Name <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="rname" id="rname" placeholder="Report Name" value="<?php echo (isset($pay_details_specific['rname'])) ? $pay_details_specific['rname'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Email ID <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email ID" value="<?php echo (isset($pay_details_specific['email'])) ? $pay_details_specific['email'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                             <label>Client Country <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="country" id="country" placeholder="Client Name" value="<?php echo (isset($pay_details_specific['country'])) ? $pay_details_specific['country'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                             <label>Client Phone No.<span class="error">*</span></label>
                                             <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Client Name" value="<?php echo (isset($pay_details_specific['phone_no'])) ? $pay_details_specific['phone_no'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                       
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                             <label>Client Name <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="cname" id="cname" placeholder="Client Name" value="<?php echo (isset($pay_details_specific['cname'])) ? $pay_details_specific['cname'] : ""; ?>">
                                        </div>
                                        </div>
                                       
                                        
                                        <div class="col-lg-6">
                                        <div class="form-group">
                                             <label>Client Company Name <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="ccompanyname" id="ccompanyname" placeholder="Client Company Name" value="<?php echo (isset($pay_details_specific['company'])) ? $pay_details_specific['company'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Description </label>
                                             <input class="form-control" type="text" name="description" id="description" placeholder="Description" value="<?php echo (isset($pay_details_specific['rdesc'])) ? $pay_details_specific['rdesc'] : ""; ?>">
                                        </div>
                                        </div>
                                           
                                            <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>License Type</label>
                                                 <div class="radio">
                                                  <label class="padding-0">
                                                 <input type="radio" name="lic" id="lic" value="Single User License" <?php echo (isset($pay_details_specific['ltype']) && $pay_details_specific['ltype'] == 'Single User License'|| $pay_details_specific['ltype'] == '' ) ? "checked" : ""; ?>>
                                                 <span class="cr"><i class="cr-icon fa fa-check"></i></span>Single LIC
                                                 </label>
                                                 </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="lic" id="lic" value="Multi User License" <?php echo (isset($pay_details_specific['ltype']) && $pay_details_specific['ltype'] == 'Multi User License') ? "checked" : ""; ?>>
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Multi LIC
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="radio">
                                             <label class="padding-0">
                                             <input type="radio" name="lic" id="lic" value="Corporate License" <?php echo (isset($pay_details_specific['ltype']) && $pay_details_specific['ltype'] == 'Corporate License') ? "checked" : ""; ?>>
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Corporate LIC
                                             </label>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                             <label>Currency</label>
                                            <div class="radio">
                                             <label class="padding-0">
                                             <input type="radio" name="currency" id="currency1" value="USD" <?php echo (isset($pay_details_specific['currency']) && $pay_details_specific['currency'] == 'USD'|| $pay_details_specific['currency'] == '' ) ? "checked" : ""; ?>>
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>USD
                                             </label>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="radio">
                                             <label class="padding-0">
                                             <input type="radio" name="currency" id="currency2" value="INR" <?php echo (isset($pay_details_specific['currency']) && $pay_details_specific['currency'] == 'INR') ? "checked" : ""; ?>>
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>INR
                                             </label>
                                            </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                             <label>Amount <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo (isset($pay_details_specific['amount'])) ? $pay_details_specific['amount'] : ""; ?>">
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Additional Note </label>
                                             <input type="text" class="form-control" name="addnote" id="addnote" placeholder="Additional Note" value="<?php echo (isset($pay_details_specific['adnote'])) ? $pay_details_specific['adnote'] : ""; ?>">
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
<script src="<?php echo SITEADMIN; ?>js/create-paylink.js"></script>

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
