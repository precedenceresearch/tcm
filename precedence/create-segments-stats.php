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
                                        <div class="segment">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                 <input type="hidden" name="report_id" id="report_id"  class="form-control" value="<?php echo $report_id; ?>">
                                                <label class="pb-0">Segment Title 1</label>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="form-check form-check pe-4 pt-2 d-none">
                                                        <input class="form-check-input d-none" type="checkbox" value="1" id="flexCheckDefault" name="volumeSegment[0]">
                                                        <label class="form-check-label" for="flexCheckDefault"> Volume </label>
                                                    </div>
                                                    <button type="button" class="addSubsegment segment-button s-btn">Add +</button>
                                                </div>
                                            </div>
                                            <input type="text" name="segment_name[0]" placeholder="Segment Name" class="form-control">
                                            <div class="subsegmentss mt-3 ps-4">
                                               
                                            </div>
                                        </div>
                                    </div>
                            
                                <div class="mb-4">
                                    <button type="button" id="addSegment" class="add-icon-plus-options s-btn " >Add Segment</button>
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
    let segmentCounter = 0; // Initialize a counter for segments
    let subsegmentCounter = 0;

    // Add segment functionality
    $('#addSegment').on('click', function() {
        segmentCounter++; // Increment the segment counter
        const segmentContainer = $('<div>').addClass('segment mt-3');

        segmentContainer.html(`
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label> Segment Title ${segmentCounter}</label>
                <div class="d-flex justify-content-center align-items-center"> 
                    <div class="form-check form-check pe-4 pt-2 d-none">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault[${segmentCounter}]" name="volumeSegment[${segmentCounter}]" checked>
                        <label class="form-check-label" for="flexCheckDefault[${segmentCounter}]"> Volume </label>
                    </div>
                    <button type="button" class="addSubsegment segment-button s-btn ms-2 me-2">Add +</button>
                    <button type="button" class="removeSegment btn-danger">X</button>
                </div>
            </div>

            <input type="text" name="segment_name[${segmentCounter}]" placeholder="Segment Name ${segmentCounter}" class="form-control">
            <div class="subsegmentss mt-3 ps-4">
                <!-- Subsegment fields will be added here -->
            </div>
        `);

        $('#new-segments').append(segmentContainer);
    });

    // Remove segment functionality
    $('#new-segments').on('click', '.removeSegment', function() {
        $(this).closest('.segment').remove();
    });

    // Add subsegment functionality
    $('#myForm').on('click', '.addSubsegment', function() {
        subsegmentCounter++;
        const subsegmentContainer = $('<div>').addClass('mb-3 align-items-center subsegments');
        const segmentInput = $(this).closest('.segment').find('input[name^="segment_name"]');
        const segmentId = segmentInput.attr('name').match(/\[(.*?)\]/)[1];

        subsegmentContainer.html(`
            <div class="d-flex align-items-center">
                <label class="pe-3 pb-0">Sub Segment</label>
                <input type="text" name="subsegment_name[${segmentId}][]" placeholder="Sub Segment Name" class="form-control w-72">
                <button type="button" class="removeSubsegment btn-danger">X</button>
            </div> 
        `);

        $(this).closest('.segment').find('.subsegmentss').append(subsegmentContainer);
    });

    // Remove subsegment functionality
    $('#myForm').on('click', '.removeSubsegment', function() {
        $(this).closest('.subsegments').remove();
    });

    // Submit the form
    $('#submitForm').on('click', function(e) {
        e.preventDefault();

        const formData = new FormData($('#myForm')[0]);

        $.ajax({
            type: 'POST',
            url: '<?php echo SITEADMIN; ?>create-segments-action-q.php', 
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                $("#loader1").show();
                $("#submitForm").attr("disabled", true);
            },
            success: function(data) {
                if (data.status === 'success') {
                    swal({
                        title: 'Success!',
                        text: 'Data received and inserted successfully',
                        icon: 'success',
                        button: 'OK',
                    }).then(function() {
                        $("#loader1").hide();
                      
                    });
                } else {
                    swal({
                        title: 'Error!',
                        text: 'Unexpected response from the server.',
                        icon: 'error',
                        button: 'OK',
                    });
                    console.error('Unexpected response:', data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loader1").hide();
                $("#submitForm").attr("disabled", false);
                let errorMessage = 'An error occurred. Please try again.';

                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                } else if (jqXHR.status) {
                    errorMessage = `Error ${jqXHR.status}: ${jqXHR.statusText}`;
                }

                swal({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error',
                    button: 'OK',
                });

                console.error('Error details:', textStatus, errorThrown, jqXHR.responseText);
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownContainer = document.querySelector('.dropdown-container');
    const dropdownSelected = dropdownContainer.querySelector('#company-search');
    const dropdownMenu = dropdownContainer.querySelector('.dropdown-menu');
    const checkboxes = dropdownMenu.querySelectorAll('.company-checkbox');
    const selectedCompaniesDiv = document.getElementById('selected-companies');
    
    // Toggle dropdown visibility
    dropdownSelected.addEventListener('click', function() {
        const isVisible = dropdownMenu.style.display === 'block';
        dropdownMenu.style.display = isVisible ? 'none' : 'block';
    });

 
    document.addEventListener('click', function(event) {
        if (!dropdownContainer.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

   
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const selectedCompanies = Array.from(checkboxes)
                .filter(c => c.checked)
                .map(c => c.nextElementSibling.textContent.trim());

            // Update the search input with the selected companies
            dropdownSelected.value = selectedCompanies.length > 0 
                ? selectedCompanies.join(', ') 
                : 'Search Companies';

            // Update the selected companies div above the dropdown
            selectedCompaniesDiv.innerHTML = selectedCompanies.length > 0
                ? 'Selected: ' + selectedCompanies.join(', ')
                : '';
        });
    });

    document.getElementById('company-search-dropdown').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        checkboxes.forEach(function(checkbox) {
            const label = checkbox.nextElementSibling.textContent.toLowerCase();
            const formCheck = checkbox.closest('.form-check');
            if (label.indexOf(filter) > -1) {
                formCheck.style.display = 'block';
            } else {
                formCheck.style.display = 'none';
            }
        });
    });
});

</script>