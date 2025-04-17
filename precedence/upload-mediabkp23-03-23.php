<?php
require_once("classes/cls-blog.php");

$obj_blog = new Blog();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

if (isset($_GET['blog_id']) && $_GET['blog_id'] != "") {
    $blog_id = base64_decode($_GET['blog_id']);
    $condition = "`id` = '" . base64_decode($_GET['blog_id']) . "'";
    $blog_details = $obj_blog->getBlogDetails('', $condition, '', '', 0);
    $blog_details_specific = end($blog_details);
}
else {
    $blog_details_specific['status'] = ""; 
    
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
    color:#fff!important;
    background-color:#10238d!important;
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
                                            
                                            <?php if(isset($_GET['editimgname'])){?>
                                            <input type="hidden" name="editimg" id="editimg" value="<?php echo $_GET['editimgname'];?>">
                                            <img src="<?php echo SITEADMIN.base64_decode($_GET['editimgname']);?>" height="100" width="100" />
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
                                    <!-- <div class="row mt-3">-->
                                    <!--    <div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <select name="" id="maxRows" class="form-control" style="width:150px;">-->
                                    <!--            <option value="10">10</option>-->
                                    <!--            <option value="20">20</option>-->
                                    <!--            <option value="50">50</option>-->
                                    <!--            <option value="100">100</option>-->
                                    <!--            <option value="500">500</option>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--    </div>-->
                                        
                                    <!--</div>-->
                                    <input type="hidden" id="maxRows" value="500">
                                    <div class="row mt-12">
                                       
                                        <div class="col-md-12">
                                         <div class="pagination-container">
                                            <nav>
                                                <ul class="pagination"></ul>
                                            </nav>
                                        </div>
                                        </div>
                                    </div>
                            <div class="row mt-3">
                                
                    <div class="col-md-12">
                       
                        <div class="table-responsive bg-white position-relative" id="target-content">
                             
                           <table class="table table-hover table-nowrap leadbox-listing" id="mytable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th scope="col">Images</th>
                                        <th>Image Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                              <?php  
                                    $sno=1;
                                    $images = glob("../insightimg/*.*");
                                  if(count($images)>0){
                                    foreach($images as $image) {?> 
                                
                                <tr>
                                    <td class="f_name"><?php echo $sno;?></td>
                                    <td><a class="example-image-link" href="<?php echo SITEADMIN.$image; ?>" data-lightbox="image-<?php echo $sno;?>"><img src="<?php echo $image;?>" height="100" width="100" /></a></td>
                                    <td><div class="clipboard">
                                            <input onclick="copy('<?php echo $sno;?>')" class="copy-input" value="<?php echo SITEADMIN.$image; ?>" id="copyClipboard<?php echo $sno;?>" readonly>
                                            <button class="copy-btn" id="copyButton" onclick="copy('<?php echo $sno;?>')">Copy Link <i class="fa fa-copy"></i></button>
                                            <div id="copied-success<?php echo $sno;?>" class="copied">
                                                <span>Copied!</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div style="display:flex;">
                                            <a class="m-1" title="Edit Image" href="<?php echo SITEADMIN?>upload-media?editimgname=<?php echo base64_encode($image);?>">
                                            <img src="<?php echo SITEADMIN."images/writing.png";?>" height="30" width="30"></a>
                                            <a class="m-1" title="Delete Image" href="<?php echo SITEADMIN?>delete-image.php?delimgname=<?php echo base64_encode($image);?>">
                                            <img src="<?php echo SITEADMIN."images/delete.png";?>" height="30" width="30"></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $sno++; } } else {?>
                                <tr>
                                    <td class="f_name text-center" colspan="4">No Image Found</td>
                                    
                                </tr>
                                <?php }?>
                                </tbody>
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
    
</script>
<script>
$( document ).ready(function() { 
            var table = '#mytable';
            var trnum = 0
            var maxRows = parseInt($('#maxRows').val());
            var totalRows = $(table+' tbody tr').length;
            $(table+' tr:gt(0)').each(function(){
                     trnum++;
                     if(trnum > maxRows){
                         $(this).hide()
                     }
                     if(trnum <= maxRows){
                         $(this).show()
                     }
             })
             if(totalRows > maxRows){
                 var pagenum = Math.ceil(totalRows/maxRows)
                 for(var i=1;i<=pagenum;){
                     $('.pagination').append('<li style="cursor:pointer;" class="page-link page-item" data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
                 }
             }
             
             $('.pagination li:first-child').addClass('active')
             $('.pagination li').on('click',function(){
                 var pageNum = $(this).attr('data-page')
                 var trIndex = 0;
                 $('.pagination li').removeClass('active')
                 $(this).addClass('active')
                 $(table+' tr:gt(0)').each(function(){
                     trIndex++
                     if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                         $(this).hide()
                     }else{
                         $(this).show()
                     }
                 })
             })
             
             $('#maxRows').on('change', function(){
                 $('.pagination').html('')
                 var trnum = 0
                 var maxRows = parseInt($(this).val())
                 //alert(maxRows);
                 var totalRows = $(table+' tbody tr').length
                 $(table+' tr:gt(0)').each(function(){
                     trnum++
                     if(trnum > maxRows){
                         $(this).hide()
                     }
                     if(trnum <= maxRows){
                         $(this).show()
                 }
             })
             
             if(totalRows > maxRows){
                 var pagenum = Math.ceil(totalRows/maxRows)
                 for(var i=1;i<=pagenum;){
                     $('.pagination').append('<li class="page-link page-item" data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
                 }
             }
             
             $('.pagination li:first-child').addClass('active')
             $('.pagination li').on('click',function(){
                 var pageNum = $(this).attr('data-page')
                 var trIndex = 0;
                 $('.pagination li').removeClass('active')
                 $(this).addClass('active')
                 $(table+' tr:gt(0)').each(function(){
                     trIndex++
                     if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                         $(this).hide()
                     }else{
                         $(this).show()
                     }
                 })
             })
             })
             $(function(){ 
                 
                 //$('table tr:eq(0)').prepend('<th>ID</th>')
                 var id = 0;
                 $('table tr:gt(0)').each(function(){
                     id++
                    // $(this).prepend('<td>'+id+'</id>')
                 })
                 
             })
});
        
</script>
