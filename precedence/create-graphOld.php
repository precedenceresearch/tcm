<?php
require_once("classes/cls-graph.php");

$obj_graph = new Graph();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

// if (isset($_GET['pay_id']) && $_GET['pay_id'] != "") {
//     $pay_id = base64_decode($_GET['pay_id']);
//     $condition = "`payid` = '" . base64_decode($_GET['pay_id']) . "'";
//     $pay_details = $obj_paylink->getPaylinkDetails('', $condition, '', '', 0);
//     $pay_details_specific = end($pay_details);
// }
// else {
//     $pay_details_specific['currency'] = ""; 
//     $pay_details_specific['ltype'] = "";
    
// }

    $field="graph_id";
    $report_id = base64_decode($_GET['report_id']);
    $condition1 = "`report_id` = '" . $report_id . "'";
    $graph_details1 = $obj_graph->getGraphDetails($field, $condition1, '', '', 0);
    $chartgraphcnt = count($graph_details1);
    
   
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
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['pay_id'])) ? "Edit" : "Create"; ?> Graph</h5>
                    </div>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
                
                
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-12 ft-size">
                        <div class="panel panel-default">
                          <!--  <div class="panel-heading">
                                General User Form
                            </div>-->
                            <div class="shadow-lg add-card bg-white mt-3 mb-3">
                                <!-- /.panel-heading -->
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>create-graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>">
                                        <div class="row">
                                            
                                        <!-- / hidden fields -->
                                        
                                        <div class="col-lg-3">
                                        <div class="form-group">
                                          
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="graph" id="bargraph" value="Stacked Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Bar Chart
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                        <div class="form-group">
                                           
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="graph" id="stackedgraph" value="Stacked Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Stacked Bar Chart
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                        <div class="form-group">
                              
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="graph" id="piegraph" value="Pie Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Pie Chart
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                        <div class="form-group">
                                           
                                            <div class="radio">
                                             <label class="padding-0">
                                             <input type="radio" name="graph" id="pointgraph" value="Point Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Point Chart
                                             </label>
                                            </div>
                                        </div>
                                        </div>
                                    
                                    <!--Bar Chart-->
                                    <div id="bar-chart" style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Header Main Title </label>
                                                 <input type="text" class="form-control" name="headerbartitle" id="headerbartitle" placeholder="Header Main Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Header Sub Title </label>
                                                 <input type="text" class="form-control" name="headerbarsubtitle" id="headerbarsubtitle" placeholder="Header Sub Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>X-Coordinate Title <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="xcordtitle" id="xcordtitle" placeholder="X-Coordinate Title " value="">
                                                 <div class="star" id="xcordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Y-Coordinate Title <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="ycordtitle" id="ycordtitle" placeholder="Y-Coordinate Title " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>X-Coordinate (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="xcord" id="xcord" placeholder="X-Coordinate " value="">
                                                 <div class="star" id="xcord_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Bar Chart Value (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="bval" id="bval" placeholder="Bar Chart Value " value="">
                                                 <div class="star" id="bval_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Bar Chart Color (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="bcol" id="bcol" placeholder="Bar Chart Color " value="">
                                                 <div class="star" id="bcol_error_message"></div>
                                                 <div class="text-end pt-1">
                                                      <input type="color" id="colorpicker pt-3" value="#0000ff">
                                                 </div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Bar Chart Format ($ or %) </label>
                                                 <select class="form-select" name="bformat" id="bformat">
                                                     <option value="">Bar Chart Format</option>
                                                     <option value="$">$</option>
                                                     <option value="%">%</option>
                                                 </select>
                                            </div>
                                            </div>
                                            
                                           
                                            <div class="col-lg-12">
                                            <div class="form-group text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_bar_graph" name="generate_bar_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            
                                            </div>
                                            </div>
                                            
                                        
                                        </div>
                                        <div class="col-md-12 pt-4" id="bar-chart-graph" style="display:none;">
                                         <div id="bar<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group" style="padding-top:20px;">
                                             <label>Script For Bar Chart</label>
                                             <textarea id="barscript" name="barscript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                    </div>
                                    </div>   
                                    
                                    <!--End Bar Chart-->
                                    
                                    <!--Pie Chart-->
                                    <div id="pie-chart" style="display:none;">
                                        <div class="row">
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Header Title </label>
                                                 <input type="text" class="form-control" name="headerpietitle" id="headerpietitle" placeholder="Header Title " value="">
                                            </div>
                                        </div>
                                            
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Pie Options (Comma Separated Values) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoption" id="pieoption" placeholder="Pie Options " value="">
                                             <div class="star" id="pieoption_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Pie Options Percentage (Comma Separated Values Without % Sign) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoptioncount" id="pieoptioncount" placeholder="Pie Options Percentage " value="">
                                             <div class="star" id="pieoptioncount_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Pie Options Colors (Comma Separated Values)</label>
                                             <input type="text" class="form-control" name="pieoptioncol" id="pieoptioncol" placeholder="Pie Options Colors " value="">
                                             <div class="text-end pt-1">
                                                      <input type="color" id="colorpicker pt-3" value="#0000ff">
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group text-center pt-3">
                                             <button type="button" class="btn s-btn col-md-12" id="generate_pie_graph" name="generate_pie_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                        
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-12 pt-4" id="pie-chart-graph" style="display:none;">
                                         <div id="pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group" style="padding-top:20px;">
                                             <label>Script For Pie Chart</label>
                                             <textarea id="piescript" name="piescript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!--Point Chart-->
                                    <div id="point-chart" style="display:none;">
                                       <div class="row">
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Header Main Title </label>
                                                 <input type="text" class="form-control" name="headerpointtitle" id="headerpointtitle" placeholder="Header Main Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Header Sub Title </label>
                                                 <input type="text" class="form-control" name="headerpointsubtitle" id="headerpointsubtitle" placeholder="Header Sub Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>X-Coordinate Title <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="xcordpointtitle" id="xcordpointtitle" placeholder="X-Coordinate Title " value="">
                                                 <div class="star" id="xcordpointtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Y-Coordinate Title <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="ycordpointtitle" id="ycordpointtitle" placeholder="Y-Coordinate Title " value="">
                                                 <div class="star" id="ycordpointtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>X-Coordinate (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="xcordpoint" id="xcordpoint" placeholder="X-Coordinate " value="">
                                                 <div class="star" id="xcordpoint_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Point Chart Value (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="bvalpoint" id="bvalpoint" placeholder="Bar Chart Value " value="">
                                                 <div class="star" id="bvalpoint_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_point_graph" name="generate_point_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            
                                            </div>
                                            </div>
                                            
                                        
                                        </div>
                                            <div class="col-md-12 pt-4" id="point-chart-graph" style="display:none;">
                                             <div id="point<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                             <div class="form-group" style="padding-top:20px;">
                                                 <label>Script For Bar Chart</label>
                                                 <textarea id="pointscript" name="pointscript" class="form-control" style="height:33px;" readonly></textarea>
                                             </div>
                                    </div>

                                    </div>
                                        <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center" style="padding-top:33px;">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit" disabled>Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                     </form>
                                    
                                      <!--Stacked Chart-->
                                    <div id="stacked-chart" class="pt-3" style="display:none;">
                                    <form role="form" method="POST" action="<?php echo SITEADMIN; ?>graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="graph" id="graph" value="Stacked Chart" class="me-1">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id']);?>">
                   
                                        <div class="row">
                                            
                                             <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Bar Value Display</label>
                                                 <select class="form-select" name="barDisplay" id="barDisplay">
                                                     <option value="">--Value Display--</option>
                                                     <option value="1">Yes</option>
                                                     <option value="0">No</option>
                                                 </select>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Y Axis Ttitle </label>
                                                 <input type="text" class="form-control" name="yaxisTitle" id="yaxisTitle" placeholder="Y Axis" value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Years </label>
                                                 <input type="text" class="form-control" name="years" id="years" placeholder="Years " value="2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Report Title </label>
                                                 <input type="text" class="form-control" name="reportTitle" id="reportTitle" placeholder="Header Main Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>North America (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="northAmerica" id="northAmerica" placeholder="North America " value="">
                                                 <div class="star" id="xcordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Latin America (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="latinAmerica" id="latinAmerica" placeholder="Latin America " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Europe (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="europe" id="europe" placeholder="Europe" value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Asia Pacific (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="asiaPacific" id="asiaPacific" placeholder="Asia Pacific " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Middle East & Africa (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="middleEastA" id="middleEastA" placeholder="Middle East & Africa " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                          
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Bar Chart Color (Region wise) (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="barColor" id="barColor" placeholder="Bar Chart Color " value="">
                                                 <div class="star" id="bcol_error_message"></div>
                                                 <div class="text-end pt-1">
                                                      <input type="color" id="colorpicker pt-3" value="#0000ff">
                                                 </div>
                                            </div>
                                            </div>
                                       
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2 text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_stacked_graph" name="generate_stacked_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            </div>
                                            </div>
                                            
                                        
                                        </div>
                                        <div class="row">
                                            <div id="stacked_graphG" class="shadow p-4 mb-5 bg-white" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pt-4" id="stacked-script-graph" style="display:none;">
                                            <div id="stacked<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                                <div class="form-group pb-2" style="padding-top:20px;">
                                                    <label>Script For Stacked Chart</label>
                                                    <textarea id="stackedscript" name="stackedscript" class="form-control" style="height:33px;" readonly></textarea>
                                                </div>
                                        </div>
                                    
                                    <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center" style="padding-top:33px;">
                                                            <button type="submit" class="btn s-btn col-md-4" id="Stackedbtn_submit" name="Stackedbtn_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>   
                                    
                                    <!--End Stacked Chart--> 
                                     
                                     
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
    .star{color:red;font-size:12px;}
    .highcharts-credits{ display:none;}
    .highcharts-button-symbol{ display:none;}
    .highcharts-legend-item{display:none};
</style>
<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>



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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script language = "JavaScript">
$( document ).ready(function() {
    
//Radio options for different graph
    $("#bargraph").click(function(){
       $("#bar-chart").show();
       $("#stacked-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#stackedgraph").click(function(){
       $("#stacked-chart").show();
       $("#bar-chart").hide();
       $("#btn_submit").hide();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#piegraph").click(function(){
       $("#bar-chart").hide();
       $("#stacked-chart").hide();
       $("#pie-chart").show();
       $("#point-chart").hide();
    })
    
    $("#pointgraph").click(function(){
       $("#bar-chart").hide();
       $("#stacked-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").show();
    })
//End Radio options for different graph    
});
</script>


<!--Bar chart-->
<script language = "JavaScript">
$( document ).ready(function() {
    
//Validation Code of bar chart  
    $("#xcordtitle_error_message").hide();
    $("#ycordtitle_error_message").hide();
    $("#xcord_error_message").hide();
    $("#bval_error_message").hide();
    $("#bcol_error_message").hide();
    
    var xcordtitle_error_message = false;
    var ycordtitle_error_message = false;
    var xcord_error_message = false;
    var bval_error_message = false;
    var bcol_error_message = false;
    
    $("#xcordtitle").keypress(function(){
        check_xcordtitle(); 
    });
    
    $("#xcordtitle").focusout(function(){
       check_xcordtitle(); 
    });
       
    $("#ycordtitle").keypress(function(){
        check_ycordtitle(); 
    });
    
    $("#ycordtitle").focusout(function(){
       check_ycordtitle(); 
    });
    
    $("#xcord").keypress(function(){
        check_xcord(); 
    });
    
    $("#xcord").focusout(function(){
       check_xcord(); 
    });
    
    $("#bval").keypress(function(){
        check_bval(); 
    });
    
    $("#bval").focusout(function(){
       check_bval(); 
    });
    
    $("#bcol").keypress(function(){
        check_bcol(); 
    });
    
    $("#bcol").focusout(function(){
       check_bcol(); 
    });
    
    function check_xcordtitle(){
       var xcordtitle = $("#xcordtitle").val();
       if(xcordtitle=="")
       {
           $("#xcordtitle_error_message").show();
           $("#xcordtitle_error_message").html("Please Enter X-Coordinate Title");
           xcordtitle_error_message=true;
       }
       else
       {
           $("#xcordtitle_error_message").hide();
           $("#xcordtitle_error_message").html("");
           xcordtitle_error_message=false;
       }
    }
    function check_ycordtitle(){
       var ycordtitle = $("#ycordtitle").val();
       if(ycordtitle=="")
       {
           $("#ycordtitle_error_message").show();
           $("#ycordtitle_error_message").html("Please Enter Y-Coordinate Title");
           ycordtitle_error_message=true;
       }
       else
       {
           $("#ycordtitle_error_message").hide();
           $("#ycordtitle_error_message").html("");
           ycordtitle_error_message=false;
       }
       
    }
    function check_xcord(){
       var xcord = $("#xcord").val();
       if(xcord=="")
       {
           $("#xcord_error_message").show();
           $("#xcord_error_message").html("Please Enter X-Coordinates");
           xcord_error_message=true;
       }
       else
       {
           $("#xcord_error_message").hide();
           $("#xcord_error_message").html("");
           xcord_error_message=false;
       }
       
    }
    function check_bval(){
       var bval = $("#bval").val();
       if(bval=="")
       {
           $("#bval_error_message").show();
           $("#bval_error_message").html("Please Enter Bar Values");
           bval_error_message=true;
       }
       else
       {
           $("#bval_error_message").hide();
           $("#bval_error_message").html("");
           bval_error_message=false;
       }
    }
    
    function check_bcol(){
       var bcol = $("#bcol").val();
       if(bcol=="")
       {
           $("#bcol_error_message").show();
           $("#bcol_error_message").html("Please Enter Bar Colors");
           bcol_error_message=true;
       }
       else
       {
           $("#bcol_error_message").hide();
           $("#bcol_error_message").html("");
           bcol_error_message=false;
       }
    }
//End Validation Code of bar chart 


//Bar graph generation code    
    $("#generate_bar_graph").click(function(){
       var hmaintitle = $("#headerbartitle").val();
       var hsubtitle = $("#headerbarsubtitle").val();
       var xcordtitle = $("#xcordtitle").val();
       var ycordtitle = $("#ycordtitle").val();
       var xcord = $("#xcord").val();
       var bval = $("#bval").val();
       var bcol = $("#bcol").val();
       var bformat = $("#bformat").val();
       
       check_xcordtitle(); 
       check_ycordtitle(); 
       check_xcord(); 
       check_bval(); 
       check_bcol();
    
       if(bval_error_message === false && xcord_error_message === false && ycordtitle_error_message === false && xcordtitle_error_message === false && bcol_error_message === false)
       {
            $("#bar-chart-graph").show();
            $("#barscript").val('<div class="d-none">Bar Chart <?php echo $chartgraphcnt;?></div><div id="bar<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>" class="graph_chart_view"></div>');
            $('#btn_submit').prop('disabled', false);
            
            var xcordinate = xcord.split(",");
            var barvalue = bval.split(",");
            var barcol = bcol.split(",");
            
            if(xcordinate.length > 0)
            {
                 var bardata=[];
                 for(var i = 0; i < xcordinate.length; i++)
                 {
                    var Headerbar = {
                                  name: xcordinate[i],
                                  y: parseInt(barvalue[i]),
                                  drilldown: xcordinate[i],
                                  color: barcol[i]
                                }
                    bardata.push(Headerbar);
                      
                 }
                 if(bformat=="$")
                 {
                    var formatdata = bformat+'{point.y:.1f}';
                 }
                 else if(bformat=="%")
                 {
                    var formatdata = '{point.y:.1f}'+bformat;
                 }
                 else
                 {
                    var formatdata = '{point.y:.1f}';
                 }
                //Bar Chart Code
                Highcharts.chart('bar'+<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>, {
                  chart: {
                    type: 'column'
                  },
                  title: {
                    align: 'left',
                    text: hmaintitle
                  },
                  subtitle: {
                    align: 'left',
                    text: hsubtitle
                  },
                  accessibility: {
                    announceNewData: {
                      enabled: true
                    }
                  },
                  xAxis: {
                    type: 'category',
                    title: {
                      text: xcordtitle
                    }
                  },
                  yAxis: {
                    title: {
                      text: ycordtitle
                    }
                
                  },
                  legend: {
                    enabled: false
                  },
                  plotOptions: {
                    series: {
                      borderWidth: 0,
                      dataLabels: {
                        enabled: true,
                        format: formatdata
                      }
                    }
                  },
                
                  tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>'+formatdata+'</b> of total<br/>'
                  },
                
                
               
                  series: [
                    {
                      name: xcordtitle,
                      colorByPoint: false,
                      data: bardata
                    }
                  ],
                  
                });
            }
            //End Bar Chart Code
       }
    })
//End Bar graph generation code  
});

</script>

<!--Stacked Graph-->
<script>
    $(document).ready(function() {
    $("#generate_stacked_graph").click(function() {
        $("#stacked_graphG").show();
        $("#stacked-script-graph").show();
        var chartId = 'stacked<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
        $("#stackedscript").val(' <div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Stacked Script" class="graph_chart_view"> Stacked Graph <?php echo $chartgraphcnt; ?> </div> </div></div>');
        
        var hmaintitle = $("#reportTitle").val();
        var years = $("#years").val().split(',').map(function(item) {
            return item.trim(); // Trimming any extra spaces
        });
        var yaxisTitle = $("#yaxisTitle").val();
        var northAmerica = $("#northAmerica").val().split(', ').map(Number);
        var latinAmerica = $("#latinAmerica").val().split(', ').map(Number);
        var europe = $("#europe").val().split(', ').map(Number);
        var asiaPacific = $("#asiaPacific").val().split(', ').map(Number);
        var middleEastA = $("#middleEastA").val().split(', ').map(Number);
        var bcol = $("#bcol").val();
        var barDisplay = $("#barDisplay").val();
        
        if (!hmaintitle) {
            alert("Report Title is Empty");
            return;
        }

        Highcharts.chart('stacked_graphG', {
            chart: {
                type: 'column'
            },
            title: {
                text: hmaintitle,
                align: 'left',
                style: {
                    fontSize: '15px',
                    fontWeight: 'bold'
                }
            },
            xAxis: {
                categories: years,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: yaxisTitle,
                    style: {
                        fontSize: '14px'
                    }
                },
                stackLabels: {
                    enabled: false
                }
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                itemStyle: {
                    fontSize: '12px'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}',
                style: {
                    fontSize: '12px'
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: 'North America',
                data: northAmerica,
                color: '#00715D'
            }, {
                name: 'Latin America',
                data: latinAmerica,
                color: '#C99764'
            }, {
                name: 'Europe',
                data: europe,
                color: '#FDB139'
            }, {
                name: 'Asia Pacific',
                data: asiaPacific,
                color: '#FDD65B'
            }, {
                name: 'Middle East & Africa',
                data: middleEastA,
                color: '#C5D8CA'
            }]
        });
    });
});
</script>
<!-- End Stacked Graph -->

<!--//Pie Chart-->
<script language = "JavaScript">
$( document ).ready(function() {
   
    //Validation Code of pie chart  
    $("#pieoption_error_message").hide();
    $("#pieoptioncount_error_message").hide();
    
    var pieoption_error_message = false;
    var pieoptioncount_error_message = false;
    
    $("#pieoption_error_message").keypress(function(){
        check_pieoption(); 
    });
    
    $("#pieoption_error_message").focusout(function(){
       check_pieoption(); 
    });
    
    $("#pieoptioncount_error_message").keypress(function(){
        check_pieoptioncount(); 
    });
    
    $("#pieoptioncount_error_message").focusout(function(){
       check_pieoptioncount(); 
    });
    
    function check_pieoption(){
       var pieoption = $("#pieoption").val();
       if(pieoption=="")
       {
           $("#pieoption_error_message").show();
           $("#pieoption_error_message").html("Please Enter Pie Options");
           pieoption_error_message=true;
       }
       else
       {
           $("#pieoption_error_message").hide();
           $("#pieoption_error_message").html("");
           pieoption_error_message=false;
       }
    }
    function check_pieoptioncount(){
       var pieoptioncount = $("#pieoptioncount").val();
       if(pieoptioncount=="")
       {
           $("#pieoptioncount_error_message").show();
           $("#pieoptioncount_error_message").html("Please Enter Pie Options Count");
           pieoptioncount_error_message=true;
       }
       else
       {
           $("#pieoptioncount_error_message").hide();
           $("#pieoptioncount_error_message").html("");
           pieoptioncount_error_message=false;
       }
       
    }
  
//End Validation Code of pie chart
   
   //Pie chart generation code    
    $("#generate_pie_graph").click(function(){
       var headerpietitle = $("#headerpietitle").val();
       var poption = $("#pieoption").val();
       var poptioncount = $("#pieoptioncount").val();
       var pieoptioncol = $("#pieoptioncol").val();
       check_pieoption(); 
       check_pieoptioncount(); 
       
    
       if(pieoptioncount_error_message === false && pieoption_error_message === false)
       {
            $("#pie-chart-graph").show();
            $("#piescript").val('<div class="d-none">Pie Chart <?php echo $chartgraphcnt;?></div><div id="pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>" class="graph_chart_view"></div>');
            $('#btn_submit').prop('disabled', false);
            
            var poptions = poption.split(",");
            var poptioncounts = poptioncount.split(",");
            if(pieoptioncol!="")
            {
                 var pieoptioncols = pieoptioncol.split(",");
            }
            if(poptions.length>0)
            {
                var piedata=[];
                for(var j = 0; j < poptions.length; j++)
                {
                    if(pieoptioncol!="")
                    {
                        var Headerpie = {
                                  name: poptions[j],
                                  y: parseInt(poptioncounts[j]),
                                  color: pieoptioncols[j]
                                }
                    }
                    else
                    {
                        var Headerpie = {
                                  name: poptions[j],
                                  y: parseInt(poptioncounts[j])
                                  
                                }
                    }
                    piedata.push(Headerpie);
                      
                }
                
                Highcharts.setOptions({
                  colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                      radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                      },
                      stops: [
                        [0, color],
                        [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                      ]
                    };
                  })
                });
                
                // Build the chart
                Highcharts.chart('pie'+<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>, {
                  chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                  },
                  title: {
                    text: headerpietitle
                  },
                  tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                  },
                  accessibility: {
                    point: {
                      valueSuffix: '%'
                    }
                  },
                  plotOptions: {
                    pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        connectorColor: 'silver'
                      }
                    }
                  },
                  series: [{
                    name: 'Piechart',
                    data: piedata
                  }]
                });
            }
       }
    });
//End Pie chart generation code  
});
</script>
<!--End Pie Chart-->

<!--//Point Chart-->
<script language = "JavaScript">
$( document ).ready(function() {
   
    //Validation Code of point chart  
    $("#xcordpointtitle_error_message").hide();
    $("#ycordpointtitle_error_message").hide();
    $("#xcordpoint_error_message").hide();
    $("#bvalpoint_error_message").hide();
    
    var xcordpointtitle_error_message = false;
    var ycordpointtitle_error_message = false;
    var xcordpoint_error_message = false;
    var bvalpoint_error_message = false;
    
    $("#xcordpointtitle").keypress(function(){
        check_xcordpointtitle(); 
    });
    
    $("#xcordpointtitle").focusout(function(){
       check_xcordpointtitle(); 
    });
       
    $("#ycordpointtitle").keypress(function(){
        check_ycordpointtitle(); 
    });
    
    $("#ycordpointtitle").focusout(function(){
       check_ycordpointtitle(); 
    });
    
    $("#xcordpoint").keypress(function(){
        check_xcordpoint(); 
    });
    
    $("#xcordpoint").focusout(function(){
       check_xcordpoint(); 
    });
    
    $("#bvalpoint").keypress(function(){
        check_bvalpoint(); 
    });
    
    $("#bvalpoint").focusout(function(){
       check_bvalpoint(); 
    });
    
    
    function check_xcordpointtitle(){
       var xcordpointtitle = $("#xcordpointtitle").val();
       if(xcordpointtitle=="")
       {
           $("#xcordpointtitle_error_message").show();
           $("#xcordpointtitle_error_message").html("Please Enter X-Coordinate Title");
           xcordpointtitle_error_message=true;
       }
       else
       {
           $("#xcordpointtitle_error_message").hide();
           $("#xcordpointtitle_error_message").html("");
           xcordpointtitle_error_message=false;
       }
    }
    function check_ycordpointtitle(){
       var ycordpointtitle = $("#ycordpointtitle").val();
       if(ycordpointtitle=="")
       {
           $("#ycordpointtitle_error_message").show();
           $("#ycordpointtitle_error_message").html("Please Enter Y-Coordinate Title");
           ycordpointtitle_error_message=true;
       }
       else
       {
           $("#ycordpointtitle_error_message").hide();
           $("#ycordpointtitle_error_message").html("");
           ycordpointtitle_error_message=false;
       }
       
    }
    function check_xcordpoint(){
       var xcordpoint = $("#xcordpoint").val();
       if(xcordpoint=="")
       {
           $("#xcordpoint_error_message").show();
           $("#xcordpoint_error_message").html("Please Enter X-Coordinates");
           xcordpoint_error_message=true;
       }
       else
       {
           $("#xcordpoint_error_message").hide();
           $("#xcordpoint_error_message").html("");
           xcordpoint_error_message=false;
       }
       
    }
    function check_bvalpoint(){
       var bvalpoint = $("#bvalpoint").val();
       if(bvalpoint=="")
       {
           $("#bvalpoint_error_message").show();
           $("#bvalpoint_error_message").html("Please Enter Point Values");
           bvalpoint_error_message=true;
       }
       else
       {
           $("#bvalpoint_error_message").hide();
           $("#bvalpoint_error_message").html("");
           bvalpoint_error_message=false;
       }
    }
    
    
//End Validation Code of poin chart 
    
   //Point chart generation code    
    $("#generate_point_graph").click(function(){
           var headerpointtitle = $("#headerpointtitle").val();
           var headerpointsubtitle = $("#headerpointsubtitle").val();
           var xcordpointtitle = $("#xcordpointtitle").val();
           var ycordpointtitle = $("#ycordpointtitle").val();
           var xcordpoint = $("#xcordpoint").val();
           var bvalpoint = $("#bvalpoint").val();
           
           check_xcordpointtitle(); 
           check_ycordpointtitle(); 
           check_xcordpoint(); 
           check_bvalpoint(); 
           
           if(xcordpointtitle_error_message === false && ycordpointtitle_error_message === false && xcordpoint_error_message === false && bvalpoint_error_message === false)
           {
            $("#point-chart-graph").show();
            $("#pointscript").val('<div class="d-none">Point Chart <?php echo $chartgraphcnt;?></div><div id="point<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>" class="graph_chart_view"></div>');
            $('#btn_submit').prop('disabled', false);
            
            var xcordinatepoint = xcordpoint.split(",");
            var barvaluepoint = bvalpoint.split(",");
             
            
            if(xcordinatepoint.length > 0)
            {
                var pointdata=[];
                for(var $k=0;$k<barvaluepoint.length;$k++)
                {
                    Headerpoint=parseInt(barvaluepoint[$k]);
                    pointdata.push(Headerpoint);
                }
                
                Highcharts.chart('point'+<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>, {
                  chart: {
                    type: 'line'
                  },
                  title: {
                    text: headerpointtitle
                  },
                  subtitle: {
                    text: headerpointsubtitle
                  },
                  xAxis: {
                    title: {
                      text: xcordpointtitle
                    },
                    categories: xcordinatepoint
                  },
                  yAxis: {
                    title: {
                      text: ycordpointtitle
                    }
                  },
                  plotOptions: {
                    line: {
                      dataLabels: {
                        enabled: true
                      },
                      enableMouseTracking: true
                    }
                  },
                  series: [{
                    name: 'Pointchart',
                    data: pointdata
                  }]
                });
            }
           }
    })
//End Point chart generation code  
});


</script>
<!--End Point Chart-->