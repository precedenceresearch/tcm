<?php
require_once("classes/cls-sample.php");
$obj_report = new Sample();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
$report_id =  base64_decode($_GET['report_id']);
?>

<?php include('header.php')?>
<script src="ckeditor_new/ckeditor.js" ></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<?php include('sidebar-menu.php'); ?>
<style>
    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
      margin-right: 0.5rem;
    }
    .lg-shadow {
        /* box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important; */
        -webkit-box-shadow: 0 2px 8px rgb(0 0 0 / 15%)!important;
        box-shadow: 0 2px 8px rgb(0 0 0 / 15%)!important;
    }
    #page-wrapper{
        background:#f1f1f1;
    }
    Checkmark-1
    .checkmark {
        top: -10px;
    }
    .featured-cls{
        padding-top: 4px;
        padding-right: 10px;
    }
    .segment, .company, .premium{
        border: 1px dashed #b0aeae;
        padding: 15px;
    }
    .table tbody tr:hover{
        background-color:transparent;
    }
    .segment-td{
    /*    padding:1rem 0.5rem 1.5rem !important;*/
    /*}*/
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
    .btn_removeSubsegment{
            line-height: 1.1;
    }
    .btn_remove_reg, .btn_remove_cp{
        float:right;
        line-height:1.0rem;
        
    }
    .w-85{
      width:83%!important;  
    }
    .w-86{
      width:86%!important;  
    }
    .w-72{
        width:72%!important;
    }
    .removeSubsegment,.removeCompany{
        margin-left:10px;
    }
    .segment-button{
        background:#045bc6!important;
    }
    .final-s-btn{
        background:#5b0094!important;
    }
    #regionDiv {
        display: none;
    }
    .removeSegment{
        border: none!important;
        border-radius: 0.2rem;
        padding: 0.23rem 0.5rem;
    }
    .ps-6{
        padding-left:6.4rem!important;
    }
</style>

<?php
if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $report_id = base64_decode($_GET['report_id']);
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $segment_details = $obj_report->getSegmentDetails($fields, $condition, '', '', 0);
    $segment_details_specific = end($segment_details);

    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $subSegment_details = $obj_report->getSubSegmentDetails($fields, $condition, '', '', 0);
    $subsegment_details_specific = end($subSegment_details);
}

$fields = "*";
$condition = "";
$company_details = $obj_report->getCompanyDetails($fields, $condition, '', '', 0);

?>
   <div class="home-section">
        <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
            
            <style>
                 .pl-3{
                        padding-left:2.2rem!important;
                    }
            </style>
            
            <!-- Page Content -->
             <div>
                 <img src="images/Top.svg" class="img-fluid top-right-pattern">
             </div>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row d-flex align-items-center pb-3 light-bg">
                        <div class="col-lg-7">
                            <h5 class="page-header mb-2"><i class="fa fa-user"></i> Create Sample </h5>
                        </div>
                          <?php if (isset($_GET['report_id']) && $_GET['report_id'] != "") {?>
                     <div class="col-md-3">
                         <!--<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn s-btn float-end">-->
                         <!--    View Graphs</a>-->
                         <!--<a href="graph-list.php?report_id=<?php echo $_GET['report_id'];?>" target="_blank" class="btn s-btn float-end">-->
                         <!--    View Graphs</a>-->
                    </div>
                    <div class="col-md-2">
                         <a href="<?php echo SITEADMIN; ?>manage-report-stats" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php } else {?>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report-stats" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php }?>
                    </div>
    
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12 ft-size">
                            <form id="myForm" enctype="multipart/form-data" class="lead-info-form">
                                
                              <div class="lg-shadow bg-white mt-3 mb-2 p-4" id="new-segments">
                                    <h5 class="pb-2">Segmentation</h5>
                                    <?php if (!empty($segment_details)) : ?>
                                        <?php foreach ($segment_details as $segmentIndex => $segment) : ?>
                                            <div class="segment">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <input type="hidden" name="report_id" id="report_id"  class="form-control" value="<?php echo $report_id; ?>">
                                                    <input type="hidden" name="segmentId[]" value="<?php echo $segment['segmentId']; ?>">
                                                    <label class="pb-0">Segment Title</label>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                       
                                                        <button type="button" class="addSubsegment segment-button s-btn">+</button>
                                                        <!--<button type="button" class="removeSegment btn-danger">X</button>-->
                                                    </div>
                                                </div>
                                                <input type="text" name="segmentTitle[]" placeholder="Segment Title" class="form-control" 
                                                       value="<?php echo htmlspecialchars($segment['segmentTitle']); ?>">
                                
                                                <div class="subsegmentss mt-3 ps-4">
                                                   
                                                    <?php foreach ($subSegment_details as $subsegment) : ?>
                                                        <?php if ($subsegment['segmentId'] == $segment['segmentId']) : ?>
                                                            <!- <div class="subsegment mb-2">
                                                                 <div class="d-flex align-items-center">
                                                                <input type="hidden" name="subsegmentId[<?php echo $segmentIndex; ?>][]" value="<?php echo $subsegment['id']; ?>">
                                                                 <label class="pe-3 pb-0">Sub Segment</label>
                                                                <input type="text" name="subsegmentTitle[<?php echo $segmentIndex; ?>][]" 
                                                                       placeholder="Subsegment Title" class="form-control w-72"
                                                                       value="<?php echo htmlspecialchars($subsegment['subsegmentTitle']); ?>">
                                                                <!--<button type="button" class="removeSubsegment btn-danger">X</button>-->
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No segments available. Click "Add Segment" to add one.</p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="mb-4">
                                    <button type="button" id="addSegment" class="add-icon-plus-options s-btn">Add +</button>
                                </div>


                                <div class="text-center mb-3">
                                    <div id="loader1" style="text-align:center;display:none;"><img src="<?php echo SITEADMIN;?>images/loading.gif" height="30px" width="30px"></div>
                                    <button type="button" id="submitForm" class="btn s-btn final-s-btn">Submit Form</button>
                                 </div>
                             </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
       </section>
   </div>
   
 <?php include("footer.php"); ?>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.tiny.cloud/1/rq21nep9x685euodgqcz9zazuspsjti0u00fr60g5c5rlp6b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
 tinymce.init({
    selector: "textarea",
    plugins: 'advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak table paragraphgroup code',
    toolbar: 'undo redo | h2 h3 | styleselect | forecolor | bold italic | paragraphgroup | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | numlist bullist table ',
    skin: 'outside',
    image_title: true,
    rel_list: [
        { title: 'Do Follow', value: 'dofollow' }, { title: 'No Follow', value: 'nofollow' }
    ],
    link_title: false,
    default_link_target: "_blank"
});
</script>


<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready(function () {
    let segmentCounter = $('#new-segments .segment').length; 
    let subsegmentCounters = {}; 

   
    $('#new-segments .segment').each(function (index) {
        let segmentIndex = index; 
        $(this).attr('data-segment-index', segmentIndex);
        subsegmentCounters[segmentIndex] = $(this).find('.subsegment').length; 
    });

 
    $('#addSegment').on('click', function () {
        segmentCounter++;
        let newSegmentIndex = segmentCounter; 

        let newSegmentHTML = `
            <div class="segment mt-3 p-3 border rounded bg-light" data-segment-index="${newSegmentIndex}">
                <div class="d-flex justify-content-between align-items-center">
                    <label>Segment Title</label>
                    <div>
                        <button type="button" class="addSubsegmentNew btn btn-sm btn-primary">+ Add Subsegment</button>
                        <button type="button" class="removeSegment btn btn-sm btn-danger">X Remove</button>
                    </div>
                </div>
                <input type="hidden" name="segmentId[]" value="new-${newSegmentIndex}">
                <input type="text" name="segmentTitle[]" class="form-control my-2" placeholder="Segment Title">
                <div class="subsegmentss mt-2"></div>
            </div>`;
        $('#new-segments').append(newSegmentHTML);
        subsegmentCounters[newSegmentIndex] = 0;
    });


    $('#new-segments').on('click', '.addSubsegment', function () {
        let segmentContainer = $(this).closest('.segment');

        // 🛠 Retrieve `data-segment-index`
        let segmentIndex = segmentContainer.attr('data-segment-index');

        if (segmentIndex === undefined) {
          
            alert("Error: Segment Index is missing. Please refresh and try again.");
            return;
        }

        subsegmentCounters[segmentIndex] = (subsegmentCounters[segmentIndex] || 0) + 1;

        let newSubsegmentHTML = `
            <div class="subsegment mb-2 d-flex align-items-center">
                <input type="hidden" name="subsegmentId[${segmentIndex}][]" value="new">
                <label class="pe-3 pb-0">Sub Segment</label>
                <input type="text" name="subsegmentTitle[${segmentIndex}][]" class="form-control w-72" placeholder="Subsegment Title">
                <button type="button" class="removeSubsegment btn btn-sm btn-danger ms-2">X</button>
            </div>`;
        segmentContainer.find('.subsegmentss').append(newSubsegmentHTML);
    });
    
    
       
    $('#new-segments').on('click', '.addSubsegmentNew', function () {
        let segmentContainer = $(this).closest('.segment');
        let segmentIndex = segmentContainer.attr('data-segment-index')-1;

        if (segmentIndex === undefined) {
          
            alert("Error: Segment Index is missing. Please refresh and try again.");
            return;
        }

        subsegmentCounters[segmentIndex] = (subsegmentCounters[segmentIndex] || 0) + 1;

        let newSubsegmentHTML = `
            <div class="subsegment mb-2 d-flex align-items-center">
                <input type="hidden" name="subsegmentId[${segmentIndex}][]" value="new">
                <label class="pe-3 pb-0">Sub Segment</label>
                <input type="text" name="subsegmentTitle[${segmentIndex}][]" class="form-control w-72" placeholder="Subsegment Title">
                <button type="button" class="removeSubsegment btn btn-sm btn-danger ms-2">X</button>
            </div>`;
        segmentContainer.find('.subsegmentss').append(newSubsegmentHTML);
    });

 
    $('#new-segments').on('click', '.removeSegment', function () {
        $(this).closest('.segment').remove();
    });

  
    $('#new-segments').on('click', '.removeSubsegment', function () {
        $(this).closest('.subsegment').remove();
    });

    
    $('#submitForm').on('click', function (e) {
        e.preventDefault();
        let formData = new FormData($('#myForm')[0]);

        $.ajax({
            type: 'POST',
            url: '<?php echo SITEADMIN; ?>edit-segments-stats-action.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                $("#loader1").show();
                $("#submitForm").attr("disabled", true);
            },
            success: function (data) {
                console.log(data);
                $("#loader1").hide();
                $("#submitForm").attr("disabled", false);
                if (data.status == 'success') {
                    swal("Success!", "Segments and Subsegments saved successfully!", "success").then(() => {
                        location.reload();
                    });
                } else {
                    swal("Error!", data.message || "Unexpected error occurred.", "error");
                }
            },
            error: function (jqXHR) {
                $("#loader1").hide();
                
                 swal("Success!", "Segments and Subsegments saved successfully!", "success").then(() => {
                        location.reload();
                    });
               
            }
        });
    });
});






</script>


<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});
</script>

