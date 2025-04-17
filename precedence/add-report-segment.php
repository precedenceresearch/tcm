<?php
require_once("classes/cls-report.php");

$obj_report = new Report();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$condition="`report_id`='".base64_decode($_GET['report_id'])."'";
$fields = "report_id,reportSubject";
$report_details = $obj_report->getReportDetails($fields, $condition, '', '', 0);
$report_detail=end($report_details);
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
<script src="ckeditor/ckeditor.js" ></script>
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> Add Report Segment</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="page-header mb-2 text-center"><?php echo $report_detail['reportSubject'];?></h5>
                    </div>
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
                                <form role="form" method="POST" action="" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="report-form" id="report-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['report_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? $_GET['report_id'] : ""; ?>">
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                       
                                           
                                                <div class="table-responsive">  
                                                    <table class="table table-qtype" id="dynamic_field">  
                                                    <tbody>
                                                        <tr>  
                                                            <td><label>Segment Title 1</label><span class="error">*</span><input type="text" name="title[]" id="title1" placeholder="Enter Segment Title 1" class="form-control" /><span class="error" id="errortitle1"></span></td>  
                                                             
                                                        </tr> 
                                                        <tr>  
                                                            <td><label>Segment Value 1</label><span class="error">*</span><textarea rows="3" name="value[]" id="value1" placeholder="Enter Segment Value 1" class="form-control" style="height:74px;" /></textarea><span class="error" id="errorvalue1"></span></td>  
                                                             
                                                        </tr> 
                                                        </tbody>
                                                        
                                                    </table> 
                                                    <button type="button" name="add" id="add" class="btn add-icon-plus-options s-btn col-md-2">+ ADD</button>
                                                          
                                                </div>
                                        
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_segment_submit" name="btn_segment_submit">Submit</button>
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
<style>
    td{
        border-style:none;
    }
    tbody{
        border: 1px solid grey;
    }
    .btn_remove{
        float:right;
        line-height:1.0rem;
    }
    
</style>
<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<script>
$(document).ready(function () {
        var i=1;
        $('#add').click(function(){
           //var i=1;
           //alert(i);
             
        //   if(i<15)
        //   {
            i++;
            $('#dynamic_field').append('<tbody id="row'+i+'"><tr class="dynamic-addedchk"><td><label>Segment Title '+i+'</label><span class="error">*</span><input type="text" id="title'+i+'" name="title[]" placeholder="Enter Segment Title '+i+'" class="form-control" /><span class="error" id="errortitle'+i+'"></span></td></tr><tr class="dynamic-addedchk"><td><label>Segment Value '+i+'</label><span class="error">*</span><textarea rows="3" style="height:74px;" id="value'+i+'" name="value[]" placeholder="Enter Segment Value '+i+'" class="form-control" /></textarea><span class="error" id="errorvalue'+i+'"></span></td><tr><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr></tbody>');  
          CKEDITOR.replace('value'+i, {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
         //  }
        //   else
        //   {
        //       swal({title: "FAQ Limit", text: "You can add only 15 questions",icon: "warning"});
        //   }
            
        });
        
        $(document).on('click', '.btn_remove', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txx" + button_id).remove();
           i--;
        }); 
        var errorqcnt=0;
        var erroracnt=0;
        var title="";
        var value="";
        $('#btn_segment_submit').click(function(e){
            e.preventDefault();
            //alert(i);
            //alert($("#value"+k).val());
            
            //alert(CKEDITOR.instances.value1.getData());
            for(var k=1;k<=i;k++)
            {
                if($("#title"+k).val()=="")
                {
                    $("#errortitle"+k).text("Please enter segment title");
                    errorqcnt++;
                }
                else
                {
                    $("#errortitle"+k).text("");
                    if(errorqcnt>0)
                    {
                      errorqcnt--;
                    }
                }
                //var curval = value1;
                var valt = CKEDITOR.instances['value'+k].getData();
                //alert(valt);
                //alert($("#value"+k).val());
                if(valt=="")
                {
                    $("#errorvalue"+k).text("Please enter segment value");
                    erroracnt++;
                }
                else
                {
                    $("#errorvalue"+k).text("");
                    if(erroracnt>0)
                    {
                        erroracnt--;
                    }
                }
            }
           //alert(errorqcnt);
            if(errorqcnt==0 && erroracnt==0)
            {   
                for(var j=1;j<=i;j++)
                {
                    title+= $("#title"+j).val()+"¶";
                    value+= $("#value"+j).val()+"¶";
                }
                //alert(questions);
                //alert(answers);
                $.ajax({
        				url: "<?php echo SITEADMIN; ?>add-report-segment-action.php",
        				type: "POST",
        				data: {alltitles:title,allvalues:value,report_id:"<?php echo base64_decode($_GET['report_id']);?>"},
        				cache: false,
        				success: function(dataResult){
        				    //alert(dataResult);
        				    if(dataResult==1)
        				    {
        				      window.location = '<?php echo SITEADMIN;?>manage-report';
        				    }
        				}
                	});
            }
            
        });
        
});
</script>
<script>
        //CKEDITOR.replace( 'description' );
          //CKEDITOR.replace( 'toc' );
            //CKEDITOR.replace( 'tnf' );
             CKEDITOR.replace('value1', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
    
    // CKEDITOR.replace('tnf', {
    //     filebrowserUploadUrl: 'ckeditor/ck_upload.php',
    //     filebrowserUploadMethod: 'form'
    // });
</script>