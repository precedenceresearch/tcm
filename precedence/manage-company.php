<?php
require_once("classes/cls-report.php");
require_once('classes/cls-pagination.php');
require_once("classes/cls-category.php");

$obj_report = new Report();
$obj_pagination = new Pagination();
$obj_category = new Category();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$fields = "catName,catId";
$condition = "`predr_category`.`status`='Active'";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '','', 0);

?>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.css">
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
            <div class="row light-bg pb-0">
                <div class="col-md-12">
                    <h5 class="page-header mb-2">
                        <i class="icon-Lead-Box"></i>
                        Manage Companies List
                    </h5>
                </div>
            </div>
            <div class="row align-items-center light-bg pt-0">
                <div class="col-md-2">
                    <div class="search-btn shadow-lg search-filter d-block" id="vn-click">
                         <i class="fa fa-filter search-ion"></i>
                        <a href="javascript:void(0);">Filter</a>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                <div class="col-md-10 text-end">
                    <!--<a href="#" class="export-list">-->
                    <!--   <i class="fa fa-arrow-down"></i>-->
                    <!--   Export List-->
                    <!--</a>-->
                    <div class="lead-links d-flex align-items-center justify-content-end">
                                         <a href="<?php echo SITEADMIN; ?>add-company" class="s-btn ml-1 btn">
                       <i class="fa fa-plus-circle"></i>
                      Add Companies
                    </a>
                    </div>
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
            <div class="row light-bg" id="vn-info">
                <div class="col-md-12">
                    <div class="tab-content search-tab-content">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-control" type="search" placeholder="Report ID" aria-label="Search" name="repid" id="repid">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="search" placeholder="Report Title" aria-label="Search" name="reptitle" id="reptitle">
                                </div>
                                <div class="col-md-3">
                                     <select class="form-select" aria-label="Default select example" id="repcategory">
                                      <option value="">Category</option>
                                      <?php foreach($category_details as $category_detail){?>
                                       <option value="<?php echo $category_detail['catId']; ?>"><?php echo $category_detail['catName']; ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="datetimerange-input1" name="fildat" size="24" style="text-align:left" class="form-control" value="" autocomplete="off">
                                    <span class="error" id="dateval"></span>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="text-end">
                                        <input type="button" value="Submit" name="filterval" id="filterval" class="s-btn">
                                        <input type="button" value="Reset" name="resetval" id="resetval" class="reset-btn">
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>
<script type="text/javascript">
// $(document).ready(function(){
//   $("#vn-info").hide();
//   $("#vn-click").click(function(){
//     $("#vn-info").slideToggle(300);
//   });
// });
</script>
   <script type="text/javascript">
        $(document).ready(function () {
         $.ajax({
				url: "<?php echo SITEADMIN; ?>manage-company-pagination.php",
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
        
            // Trigger search on button click
    $("#filterval").click(function () {
        performSearch();
    });    
    
    // Trigger search on pressing "Enter" key in any input field
    $(".form-control, .form-select").on("keypress", function (e) {
        if (e.which === 13) {  // Enter key
            performSearch();
        }
    });
       
function performSearch() {
		    var repid=$("#repid").val();
		    var reptitle=$("#reptitle").val();
		    var repcategory=$("#repcategory").val();
		    var daterange=$("#datetimerange-input1").val();
		    var daterror=$("#dateval").text().length;
		    //alert(daterror);
		    if(daterror == 0)
		    {
    		    $.ajax({
    				url: "<?php echo SITEADMIN; ?>manage-company-pagination.php",
    				type: "GET",
    				data: {
    					page : "1",daterange:daterange,repid:repid,reptitle:reptitle,repcategory:repcategory
    				},
    				cache: false,
    			    beforeSend: function(){
                       // Show image container
                       $("#target-content").html("");
                        $("#loader1").show();
                    },
    				success: function(dataResult){
    				   // alert(dataResult);
    				    $("#loader1").hide();
    					$("#target-content").html(dataResult);
    					$(".pageitem").removeClass("active");
    					$("#1").addClass("active");
    				}
    			});
		    }
		  
}
		
		$("#resetval").click(function(){
		    $("#repid").val("");
		    $("#reptitle").val("");
		    $("#repcategory").val("");
		    $("#datetimerange-input1").val("");
		    
		    var repid="";
		    var reptitle="";
		    var repcategory="";
		    var daterange="";
		    
		    $.ajax({
				url: "<?php echo SITEADMIN; ?>manage-company-pagination.php",
				type: "GET",
				data: {
					page : "1",daterange:daterange,repid:repid,reptitle:reptitle,repcategory:repcategory
				},
				cache: false,
			    beforeSend: function(){
                   // Show image container
                   // $("#loader1").show();
                   $("#target-content").html("");
                   $("#loader1").show();
                   
                },
				success: function(dataResult){
				    //alert(dataResult);
				    $("#loader1").hide();
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#1").addClass("active");
				}
			});
		})
		
        window.addEventListener("load", function (event) {
                new DateRangePicker('datetimerange-input1');
                $("#datetimerange-input1").val("");
                $("#datetimerange-input1").attr("placeholder", "Select Date Range");
                
            });
            //$('#datetimerange-input1').data('daterangepicker').setEndDate();
        window.addEventListener("click", function (event) {
                //new DateRangePicker('datetimerange-input1');
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                 if(dd<10){
                        dd='0'+dd
                    } 
                    if(mm<10){
                        mm='0'+mm
                    } 
                
                var maxdate = mm+'/'+dd+'/'+yyyy;
                //alert(maxdate);
                
                var seldat=$("#datetimerange-input1").val();
                var fulldat=seldat.split("-");
                var todat12=fulldat[1];
               
                
                var startDay = new Date(maxdate);  
                var endDay = new Date(todat12);  
              
                // Determine the time difference between two dates     
                var millisBetween = startDay.getTime() - endDay.getTime();  
              
                // Determine the number of days between two dates  
                var days = millisBetween / (1000 * 3600 * 24);  
                if(days<0)
                {
                    $("#dateval").text("Please select correct date");
                    //var flag3=1;
                    
                }
                else
                {
                    $("#dateval").text("");
                   // var flag3=0;
                }
                //alert(flag3);
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