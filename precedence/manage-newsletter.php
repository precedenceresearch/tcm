<?php
require_once("classes/cls-newsletter.php");
require_once('classes/cls-pagination.php');

$obj_newsletter = new Newsletter();
$obj_pagination = new Pagination();

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
                    <div class="col-md-3">
                        <h5 class="page-header"><i class="fa fa-user"></i> Manage Newsletter List</h5>
                        <!--<ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Manage User</li>
                        </ol>-->
                        
                    </div>
                    
                    
                    <!-- /.col-lg-12 -->
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
				url: "<?php echo SITEADMIN; ?>manage-newsletter-pagination.php",
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
        // function action_published(catid)
        //     {
        //     $.ajax({
        //           url : "<?php echo SITEADMIN; ?>update-category-status-published.php",
        //           type : "POST",
        //           data : {catid:catid},
        //           success: function(data){
        //           }
        //     });
        //     }
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