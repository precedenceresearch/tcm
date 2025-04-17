<?php
require_once("classes/cls-report.php");
require_once('classes/cls-pagination.php');

$obj_report = new Report();
$obj_pagination = new Pagination();


if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
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
                    <div class="col-lg-7">
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> View Report FAQ</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
           
            <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success alert-dismissible mt-2" role="alert">
                        <button type="button" class="close border-0" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
                    <?php } elseif (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger alert-dismissible mt-2" role="alert">
                            <button type="button" class="close border-0" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>
            
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div id="loader1" style="text-align:center;display:none;"><img src="<?php echo SITEADMIN;?>images/loading.gif"></div>
                    <div class="table-responsive bg-white position-relative" id="target-content">
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   </div>

 <?php include('footer.php') ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#vn-info").hide();
  $("#vn-click").click(function(){
    $("#vn-info").slideToggle(300);
  });
});
</script>
   <script type="text/javascript">
        $(document).ready(function () {
         $.ajax({
				url: "<?php echo SITEADMIN; ?>view-report-faq-pagination.php",
				type: "GET",
				data: {
					report_id :'<?php echo base64_decode($_GET['report_id']);?>'
				},
				cache: false,
			    beforeSend: function(){
                },
				success: function(dataResult){
				    //alert(dataResult);
				   // $("#loader1").hide();
					$("#target-content").html(dataResult);
					
				}
			});
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