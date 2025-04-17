<?php
require_once("classes/cls-media.php");

$obj_media = new Media();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}


if(isset($_GET['editimgid']))
{
    $fields="*";
    $condition = "`predr_media`.`id`='".$_GET['editimgid']."'";
    $media_edits = $obj_media->getMediaDetails($fields, $condition, '', '', 0);
    $media_edit = end($media_edits);
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
.clipboard {
  position: relative;
}
/* You just need to get this field */
.copy-input {
  max-width: 500px;
  width: 70%;
  cursor: pointer;
  /*background-color: #eaeaeb;*/
  border:none;
  color:#6c6c6c;
  font-size: 14px;
  border-radius: 1px;
  padding: 7px;
  border:1px solid #010B44;
  font-family: 'Montserrat', sans-serif;
  background-color: #e9ecef;
  opacity: 1;
  background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  /*box-shadow: 0 3px 15px #b8c6db;*/
  /*-moz-box-shadow: 0 3px 15px #b8c6db;*/
  /*-webkit-box-shadow: 0 3px 15px #b8c6db;*/
}
.copy-input:focus {
  outline:none;
}

.copy-btn {
  /*width:40px;*/
  background-color: #010B44;
  font-size: 14px;
  padding: 6px 9px;
  border-radius: 0px;
  border:none;
  color:#fff;
  margin-left:-4px;
  height:30px;
  /*transition: all .4s;*/
}
.copy-btn:hover {
  /*transform: scale(1.3);*/
  color:#fff;
  cursor:pointer;
}

.copy-btn:focus {
  outline:none;
}

.copied {
  font-family: 'Montserrat', sans-serif;
  width: 75px;
  display: none;
  position:fixed;
  /*top: 284px;*/
  left: 580px;
  right: 0;
  margin: auto;
  color:#000;
  padding: 10px 10px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 3px 15px #b8c6db;
  -moz-box-shadow: 0 3px 15px #b8c6db;
  -webkit-box-shadow: 0 3px 15px #b8c6db;
}
.active{
    background:#010B44 !important;
    color:#fff !important;
}
</style>
<link rel="stylesheet" href="<?php echo SITEADMIN; ?>dist/css/lightbox.min.css">
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> Image Gallery</h5>
                    </div>
                    <!--<div class="col-md-5">-->
                    <!--     <a href="<?php echo SITEADMIN; ?>manage-blog" class="btn s-btn float-end">-->
                    <!--        <i class="fa fa-arrow-left"></i> Back</a>-->
                    <!--</div>-->
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN;?>upload-media-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="media-form" id="media-form">
                                        <!-- hidden fields -->
                                      
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Upload Image <span class="error">*</span></label>
                                            <input type="file" class="form-control" name="img" id="img">
                                            
                                            <?php if(isset($_GET['editimgid'])){ $today=strtotime(date('Y-m-d h:i:sa'));?>
                                            <input type="hidden" name="editimg" id="editimg" value="<?php echo $media_edit['imagepath'];?>">
                                            <input type="hidden" name="editimgid" id="editimgid" value="<?php echo $media_edit['id'];?>">
                                            <img src="<?php echo $media_edit['imagepath'];?>?img=<?php echo $media_edit['id'].$today;?>" height="100" width="100" />
                                            <?php }?>
                                        </div>
                                        </div>
                                       
                                        
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <div class="text-center">
                                                    <button type="submit" class="btn s-btn col-md-2" id="btn_lead_submit" name="btn_lead_submit">Submit</button>
                                                    <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                </div>
                                            </div>
                                        </div>
                                           
                                        </div>
                                </form>
                                
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                   
                            <div class="row mt-3">
                                
                    <div class="col-md-12">
                       
                        <div class="table-responsive bg-white position-relative" id="target-content">
                             
                          
                            
                        </div>
                    </div>
                </div>
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
<script src="<?php echo SITEADMIN; ?>dist/js/lightbox-plus-jquery.min.js"></script>
<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo SITEADMIN; ?>js/add-media.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<style>
    .sr-only{display:none!important;}
</style>
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
<script type="text/javascript">
    function copy(n) {
      var copyText = document.getElementById("copyClipboard"+n);
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      
      $('#copied-success'+n).fadeIn(800);
      $('#copied-success'+n).fadeOut(800);
    }
    
    $(document).ready(function () {
         $.ajax({
				url: "<?php echo SITEADMIN; ?>upload-media-pagination.php",
				type: "GET",
				data: {
					page : "1"
				},
				cache: false,
			    beforeSend: function(){
                },
				success: function(dataResult){
				    //alert(dataResult);
				   // $("#loader1").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
			});
        });
</script>

