<?php
require_once("classes/cls-report.php");

$obj_report = new Report();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['admin_id'])) ? "Edit" : "Add"; ?> Report FAQ</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
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
                                                            <td><label>Question 1</label><span class="error">*</span><input type="text" name="question[]" id="question1" placeholder="Enter Question 1" class="form-control" /><span class="error" id="errorquestion1"></span></td>  
                                                             
                                                        </tr> 
                                                        <tr>  
                                                            <td><label>Answer 1</label><span class="error">*</span><textarea rows="3" name="answer[]" id="answer1" placeholder="Enter Answer 1" class="form-control" style="height:74px;" /></textarea><span class="error" id="erroranswer1"></span></td>  
                                                             
                                                        </tr> 
                                                        </tbody>
                                                        
                                                    </table> 
                                                    <button type="button" name="add" id="add" class="btn add-icon-plus-options s-btn col-md-2">+ ADD</button>
                                                          
                                                </div>
                                        
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_faq_submit" name="btn_faq_submit">Submit</button>
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
             
           if(i<15)
           {
            i++;
            $('#dynamic_field').append('<tbody id="row'+i+'"><tr class="dynamic-addedchk"><td><label>Question '+i+'</label><span class="error">*</span><input type="text" id="question'+i+'" name="question[]" placeholder="Enter Question '+i+'" class="form-control" /><span class="error" id="errorquestion'+i+'"></span></td></tr><tr class="dynamic-addedchk"><td><label>Answer '+i+'</label><span class="error">*</span><textarea rows="3" style="height:74px;" id="answer'+i+'" name="answer[]" placeholder="Enter Answer '+i+'" class="form-control" /></textarea><span class="error" id="erroranswer'+i+'"></span></td><tr><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr></tbody>');  
           }
           else
           {
               swal({title: "FAQ Limit", text: "You can add only 15 questions",icon: "warning"});
           }
            
        });
        
        $(document).on('click', '.btn_remove', function(){
            
           var button_id = $(this).attr("id"); 
           $('#row'+button_id+'').remove(); 
           $("#txx" + button_id).remove();
           i--;
        }); 
        var errorqcnt=0;
        var erroracnt=0;
        var questions="";
        var answers="";
        $('#btn_faq_submit').click(function(e){
            e.preventDefault();
            //alert(i);
            
            for(var k=1;k<=i;k++)
            {
                if($("#question"+k).val()=="")
                {
                    $("#errorquestion"+k).text("Please enter question");
                    errorqcnt++;
                }
                else
                {
                    $("#errorquestion"+k).text("");
                    if(errorqcnt>0)
                    {
                      errorqcnt--;
                    }
                }
                
                if($("#answer"+k).val()=="")
                {
                    $("#erroranswer"+k).text("Please enter answer");
                    erroracnt++;
                }
                else
                {
                    $("#erroranswer"+k).text("");
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
                    questions+= $("#question"+j).val()+"¶";
                    answers+= $("#answer"+j).val()+"¶";
                }
                //alert(questions);
                //alert(answers);
                $.ajax({
        				url: "<?php echo SITEADMIN; ?>add-report-faq-action.php",
        				type: "POST",
        				data: {allquestions:questions,allanswers:answers,report_id:"<?php echo base64_decode($_GET['report_id']);?>"},
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