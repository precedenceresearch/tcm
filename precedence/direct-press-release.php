<?php
require_once("classes/cls-report.php");
require_once('classes/cls-pagination.php');
require_once("classes/cls-category.php");
require_once("classes/cls-leads.php");

$obj_report = new Report();
$obj_pagination = new Pagination();
$obj_category = new Category();
$obj_lead = new Lead();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

?>
<style>
input[type="checkbox"] {
	 height: 0;
	 width: 0;
	 visibility: hidden;
}
 .toglabel {
	 cursor: pointer;
	 text-indent: -9999px;
	 width: 44px;
	 height: 25px;
	 background: #f81708;
	 display: block;
	 border-radius: 100px;
	 position: relative;
	 content: "No";
	 color:#fff;
	 margin-top: -11px;
}
 .toglabel:after {
	 content: "No";
	 position: absolute;
	 top: 3px;
	 left: 5px;
	 width: 18px;
	 height: 18px;
	 background: #fff;
	 border-radius: 90px;
	 transition: 0.3s;
}
 input:checked + .toglabel {
	 background: #34a615;
	  
}
 input:checked + .toglabel:after {
	 left: calc(100% - 5px);
	 transform: translateX(-100%);
}
 .toglabel:active:after {
	 width: 130px;
}
</style>

<?php include('header.php')?>

<?php include('sidebar-menu.php')?>
    <div class="home-section">
    <?php include("top-bar.php"); ?>
    <section class="common-space pt-3_7">
    <div class="container">
            <div class="row d-flex align-items-center pb-3 light-bg">
                    <div class="col-md-2">
                       
                    </div>
                  <div class="col-md-4">
                       <div class="form-check form-check-inline d-none">
                            <input class="form-check-input" type="radio" name="prOptions" id="clientPR" value="client" checked>
                            <label class="form-check-label" for="clientPR">Client PR</label>
                        </div>
                    </div>
                      <div class="col-md-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="prOptions" id="managePR" value="manage">
                            <label class="form-check-label" for="managePR">Manage PR</label>
                        </div>
                    </div>
                    
                      <div class="col-md-2">
                         <div class="form-check form-check-inline">
                          <a href="<?php echo SITEADMIN; ?>add-pr-manual.php" class="btn s-btn float-end"><i class="fa fa-plus-circle"></i> Add PR</a>
                         </div>
                    </div>
                
                
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close border-0" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                            
                        </div>
                    <?php } elseif (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close border-0" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                            
                        </div>
                <?php } ?>
                <!-- /.row -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive bg-white position-relative" id="target-content">
                           
                        </div>
                    </div>
                </div>
            </div>
       </section>
   </div>

 <?php include('footer.php') ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">
        $(document).ready(function () {
         $.ajax({
				url: "<?php echo SITEADMIN; ?>direct-pr-pagination.php",
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


$(document).ready(function () {
    function loadTable(page, selectedType) {
        $.ajax({
            url: "<?php echo SITEADMIN; ?>direct-pr-pagination.php",
            type: "GET",
            data: {
                page: page,
                type: selectedType
            },
            success: function (dataResult) {
                $("#target-content").html(dataResult);
                $(".pageitem").removeClass("active1");
                $("#page_" + page).addClass("active1");
                $(window).scrollTop(0);
            }
        });
    }

    // Load default (Client PR) data
  let selectedType = "manage";
    $("input[name='prOptions'][value='" + selectedType + "']").prop("checked", true);
    loadTable(1, selectedType);

    // Listen for PR type change
    $("input[name='prOptions']").change(function () {
        selectedType = $("input[name='prOptions']:checked").val();
        loadTable(1, selectedType);
    });

    // Handle pagination click
    $(document).on("click", ".page-link", function () {
        var page = $(this).attr("data-id");
        loadTable(page, selectedType);
    });
});

</script>