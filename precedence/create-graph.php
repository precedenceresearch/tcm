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
                                 <div class="row">
                                        
                                        <div class="col-lg-4"> </div> 
                                        
                                        <div class="col-lg-8">
                                        <div class="form-group pb-2 d-flex justify-content-between mb-0 pb-0">
                                            <div class="radio">
                                                <label class="padding-0">
                                                    <input type="radio" name="graph" id="stackedgraph" value="Stacked Chart" class="me-1">
                                                    <span class="cr"></span>Stacked Graph
                                                </label>
                                             </div>
                                             <div class="radio">
                                                <label class="padding-0">
                                                    <input type="radio" name="graph" id="columngraph" value="Column Chart" class="me-1">
                                                    <span class="cr"></span>Column Graph
                                                </label>
                                             </div>
                                            <div class="radio">
                                                <label class="padding-0">
                                                    <input type="radio" name="graph" id="bargraph" value="Bar Chart" class="me-1">
                                                    <span class="cr"></span>Bar Chart
                                                </label>
                                             </div>
                                            <div class="radio">
                                                <label class="padding-0">
                                                    <input type="radio" name="graph" id="piegraph" value="Pie Chart" class="me-1">
                                                    <span class="cr"></span>Pie Chart
                                                </label>
                                             </div>
                                            <div class="radio">
                                                 <label class="padding-0">
                                                 <input type="radio" name="graph" id="pointgraph" value="Point Chart" class="me-1">
                                                 <span class="cr"></span>Point Chart
                                                 </label>
                                            </div>
                                        </div>
                                        </div>
                                    
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
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>   
                                    
                                    <!--End Stacked Chart-->
                                    
                                     <!--Column Chart-->
                                    <div id="column-chart" class="pt-3" style="display:none;">
                                    <form role="form" method="POST" action="<?php echo SITEADMIN; ?>graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="graph" id="graph" value="Column Chart" class="me-1">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id'])?>">
                   
                                        <div class="row">
                                            
                                             <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Bar Value Display</label>
                                                 <select class="form-select" name="columnDisplay" id="columnDisplay">
                                                     <option value="">--Value Display--</option>
                                                     <option value="1">Yes</option>
                                                     <option value="0">No</option>
                                                 </select>
                                            </div>
                                            </div>
                                            
                                             <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Report Title </label>
                                                 <input type="text" class="form-control" name="columnreportTitle" id="columnreportTitle" placeholder="Header Main Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Y Axis Ttitle 1 </label>
                                                 <input type="text" class="form-control" name="columnyaxisTitle1" id="columnyaxisTitle1" placeholder="Y Axis" value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Y Axis Ttitle 2 </label>
                                                 <input type="text" class="form-control" name="columnyaxisTitle2" id="columnyaxisTitle2" placeholder="Y Axis" value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>X axis (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="columnXAxis" id="columnXAxis" placeholder="X Axis " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Y axis Title 1 (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="yaxis1Value" id="yaxis1Value" placeholder="Y axis Title 1 " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Y axis Title (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="yaxis2Value" id="yaxis2Value" placeholder="Y axis Title 2 " value="">
                                                 
                                            </div>
                                            </div>
                                       
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2 text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_column_graph" name="generate_column_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div id="column_graphG" class="shadow p-4 mb-5 bg-white" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pt-4" id="column-script-graph" style="display:none;">
                                         <div id="column<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group pb-2" style="padding-top:20px;">
                                             <label>Script For Column Chart</label>
                                             <textarea id="columnscript" name="columnscript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                    </div>
                                    
                                    <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center" style="padding-top:33px;">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>   
                                    
                                    <!--End Column Chart-->
                                    
                                    <!--Bar Chart-->
                                    <div id="bar-chart" style="display:none;">
                                        <form role="form" method="POST" action="<?php echo SITEADMIN; ?>graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="graph" id="graph" value="Bar Chart" class="me-1">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>">
                   
                                        <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Bar Value Display</label>
                                                 <select class="form-select" name="bar2Display" id="bar2Display">
                                                     <option value="">--Value Display--</option>
                                                     <option value="1">Yes</option>
                                                     <option value="0">No</option>
                                                 </select>
                                            </div>
                                            </div>
                   
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
                                                     <option value="€">€</option>
                                                 </select>
                                            </div>
                                            </div>
                                     
                                            <div class="col-lg-12">
                                            <div class="form-group text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_bar_graph" name="generate_bar_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            
                                            </div>
                                            </div>
                                    
                                        </div>
                                        
                                        <div class="row">
                                            <div id="bar_graphG" class="shadow p-4 mb-5 bg-white" style="display:none;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 pt-4" id="bar-chart-graph" style="display:none;">
                                         <div id="bar<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group" style="padding-top:20px;">
                                             <label>Script For Bar Chart</label>
                                             <textarea id="barscript" name="barscript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                    </div>
                                    
                                        <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center" style="padding-top:33px;">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    
                                    </div>   
                                    
                                    <!--End Bar Chart-->
    
                                    <!--Pie Chart-->
                                    <div id="pie-chart" style="display:none;">
                                        <form role="form" method="POST" action="<?php echo SITEADMIN; ?>graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="graph" id="graph" value="Pie Chart" class="me-1">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>">
                                        <div class="row">
                                            
                                            <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Pie Value Display</label>
                                                 <select class="form-select" name="pieDisplay" id="pieDisplay">
                                                     <option value="">--Value Display--</option>
                                                     <option value="1">Yes</option>
                                                     <option value="0">No</option>
                                                 </select>
                                            </div>
                                            </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Header Title </label>
                                                 <input type="text" class="form-control" name="headerpietitle" id="headerpietitle" placeholder="Header Title " value="">
                                            </div>
                                        </div>
                                            
                                        <div class="col-lg-12">
                                        <div class="form-group pb-2">
                                             <label>Pie Options (Comma Separated Values) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoption" id="pieoption" placeholder="Pie Options " value="">
                                             <div class="star" id="pieoption_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group pb-2">
                                             <label>Pie Options Percentage (Comma Separated Values Without % Sign) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoptioncount" id="pieoptioncount" placeholder="Pie Options Percentage " value="">
                                             <div class="star" id="pieoptioncount_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group pb-2">
                                             <label>Pie Options Colors (Comma Separated Values)</label>
                                             <input type="text" class="form-control" name="pieoptioncol" id="pieoptioncol" placeholder="Pie Options Colors " value="">
                                             <div class="text-end pt-1">
                                                      <input type="color" id="colorpicker pt-3" value="#0000ff">
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group pb-2 text-center pt-3">
                                             <button type="button" class="btn s-btn col-md-12" id="generate_pie_graph" name="generate_pie_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                        
                                        </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div id="pie_graphG" class="shadow p-4 mb-5 bg-white" style="display:none;">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 pt-4" id="pie-chart-graph" style="display:none;">
                                         <div id="pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group pb-2" style="padding-top:20px;">
                                             <label>Script For Pie Chart</label>
                                             <textarea id="piescript" name="piescript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-2">
                                                <div class="text-center" style="padding-top:33px;">
                                                    <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit">Submit</button>
                                                    <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </form>    
                                        
                                    </div>
                                    
                                     <!--Point Chart-->
                                    <!--Point Chart-->
                                    <div id="point-chart" style="display:none;">
                                        <form role="form" method="POST" action="<?php echo SITEADMIN; ?>graph-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="graph-form" id="graph-form">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="graph" id="graph" value="Point Chart" class="me-1">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? base64_decode($_GET['report_id']) : ""; ?>">
                                        <input type="hidden" name="barid" id="barid" value="<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>">
                   
                                        <div class="row">
                                            
                                             <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Point Value Display</label>
                                                 <select class="form-select" name="pointDisplay" id="pointDisplay">
                                                     <option value="">--Value Display--</option>
                                                     <option value="1">Yes</option>
                                                     <option value="0">No</option>
                                                 </select>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-6">
                                            <div class="form-group pb-2">
                                                 <label>Y Axis Ttitle </label>
                                                 <input type="text" class="form-control" name="pointyaxisTitle" id="pointyaxisTitle" placeholder="Y Axis" value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Years </label>
                                                 <input type="text" class="form-control" name="pointyears" id="pointyears" placeholder="Years " value="2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030, 2031, 2032, 2033" readonly>
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Report Title </label>
                                                 <input type="text" class="form-control" name="headerpointtitle" id="headerpointtitle" placeholder="Header Main Title " value="">
                                                 
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>North America (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="pointnorthAmerica" id="pointnorthAmerica" placeholder="North America " value="">
                                                 <div class="star" id="xcordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Latin America (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="pointlatinAmerica" id="pointlatinAmerica" placeholder="Latin America " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Europe (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="pointeurope" id="pointeurope" placeholder="Europe" value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Asia Pacific (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="pointasiaPacific" id="pointasiaPacific" placeholder="Asia Pacific " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Middle East & Africa (Comma Separated Values) </label>
                                                 <input type="text" class="form-control" name="pointmiddleEastA" id="pointmiddleEastA" placeholder="Middle East & Africa " value="">
                                                 <div class="star" id="ycordtitle_error_message"></div>
                                            </div>
                                            </div>
                                          
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2">
                                                 <label>Bar Chart Color (Region wise) (Comma Separated Values) <span class="error">*</span></label>
                                                 <input type="text" class="form-control" name="pointColor" id="pointColor" placeholder="Bar Chart Color " value="">
                                                 <div class="star" id="bcol_error_message"></div>
                                                 <div class="text-end pt-1">
                                                      <input type="color" id="colorpicker pt-3" value="#0000ff">
                                                 </div>
                                            </div>
                                            </div>
                                       
                                            <div class="col-lg-12">
                                            <div class="form-group pb-2 text-center pt-3">
                                                 <button type="button" class="btn s-btn col-md-12" id="generate_point_graph" name="generate_point_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                            </div>
                                            </div>
                                            
                                        
                                        </div>
                                        <div class="row">
                                            <div id="point_graphG" class="shadow p-4 mb-5 bg-white" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col-md-12 pt-4" id="point-chart-graph" style="display:none;">
                                         <div id="point<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>"></div>
                                         <div class="form-group pb-2" style="padding-top:20px;">
                                             <label>Script For Stacked Chart</label>
                                             <textarea id="pointscript" name="pointscript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                    </div>
                                    
                                    <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center" style="padding-top:33px;">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_submit" name="btn_submit">Submit</button>
                                                            <!--<button type="reset" class="btn reset-btn" id="reset">Reset</button>-->
                                                        </div>
                                                    </div>
                                                </div>
                                    </form>
                                    </div>

                                </div>
                                        <!-- /.col-lg-6 (nested) -->
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
    $("#stackedgraph").click(function(){
       $("#stacked-chart").show();
       $("#bar-chart").hide();
       $("#column-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#columngraph").click(function(){
       $("#column-chart").show();
       $("#stacked-chart").hide();
       $("#bar-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#bargraph").click(function(){
       $("#bar-chart").show();
       $("#stacked-chart").hide();
       $("#column-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#piegraph").click(function(){
        $("#stacked-chart").hide();
       $("#bar-chart").hide();
       $("#pie-chart").show();
       $("#column-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#pointgraph").click(function(){
       $("#bar-chart").hide();
       $("#stacked-chart").hide();
       $("#column-chart").hide();
       $("#pie-chart").hide();
       $("#point-chart").show();
    })
//End Radio options for different graph    
});
</script>

<!-- Column Graph-->
<script>
 $(document).ready(function() {
    $("#generate_column_graph").click(function() {
        $("#column_graphG").show();
        $("#column-script-graph").show();
        var chartId = 'column<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
        $("#columnscript").val(' <div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Column Script" class="graph_chart_view"> Column Graph <?php echo $chartgraphcnt; ?> </div> </div></div>');
        
        var hmaintitle = $("#columnreportTitle").val();
        var yaxisTitle1 = $("#columnyaxisTitle1").val();
        var yaxisTitle2 = $("#columnyaxisTitle2").val();
        var columnXAxis = $("#columnXAxis").val().split(',').map(function(item) {
            return item.trim(); // Trimming any extra spaces
        });
        
        var yaxis1Value = $("#yaxis1Value").val().split(',').map(function(item) {
            return parseFloat(item.trim());; // Trimming any extra spaces
        });
        
        var yaxis2Value = $("#yaxis2Value").val().split(',').map(function(item) {
            return parseFloat(item.trim());; // Trimming any extra spaces
        });
        
        var barDisplay = $("#columnDisplay").val();
        
        if (!hmaintitle) {
            alert("Report Title is Empty");
            return;
        }
        
        Highcharts.chart('column_graphG', {
            chart: {
                type: 'column'
            },
            title: {
                text: hmaintitle,
                align: 'left',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold'
                }
            },
            xAxis: {
                categories: columnXAxis,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: [{
                min: 0,
                title: {
                    text: yaxisTitle1,
                    style: {
                        fontSize: '14px'
                    }
                }
            }, {
                min: 0,
                title: {
                    text: yaxisTitle2,
                    style: {
                        fontSize: '14px'
                    },
                    opposite: true // Place the secondary Y-axis on the right
                }
            }],
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
                shared: true,
                style: {
                    fontSize: '12px'
                }
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: yaxisTitle1,
                data: yaxis1Value,
                yAxis: 0
            }, {
                name: yaxisTitle2,
                data: yaxis2Value,
                yAxis: 1
            }]
        });
    });
 });
</script>
<!-- End Column Graph-->

<!--Stacked Graph-->
<script>
    $(document).ready(function() {
    $("#generate_stacked_graph").click(function() {
        $("#stacked_graphG").show();
        $("#stacked-script-graph").show();
        var chartId = 'stacked<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
        $("#stackedscript").val(' <div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Stacked Script" class="graph_chart_view"> Stacked Graph <?php echo $chartgraphcnt; ?> </div> </div></div> ');
        
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
                color: '#015cd4'
            }, {
                name: 'Latin America',
                data: latinAmerica,
                color: '#0040b1'
            }, {
                name: 'Europe',
                data: europe,
                color: '#081975'
            }, {
                name: 'Asia Pacific',
                data: asiaPacific,
                color: '#2bc4f6'
            }, {
                name: 'Middle East & Africa',
                data: middleEastA,
                color: '#0003fa'
            }]
        });
    });
});
</script>
<!-- End Stacked Graph -->

<!-- Bar Graph -->
<script>
    // Bar Graph
$(document).ready(function() {
    $("#generate_bar_graph").click(function() {
        $("#bar_graphG").show();
        $("#bar-chart-graph").show();
        var chartId = 'bar<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
        $("#barscript").val('<div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Bar Script" class="graph_chart_view"> Bar Graph <?php echo $chartgraphcnt; ?> </div> </div></div>');

        var hmaintitle = $("#headerbartitle").val();
        var hsubtitle = $("#headerbarsubtitle").val();
        var xcordtitle = $("#xcordtitle").val();
        var ycordtitle = $("#ycordtitle").val();
        var xcordinate = $("#xcord").val().split(',').map(function(item) {
            return item.trim(); // Trimming any extra spaces
        });
        var barvalue = $("#bval").val().split(',').map(Number);
        var barcol = $("#bcol").val().split(',').map(function(item) {
            return item.trim(); // Trimming extra spaces
        });
        var bformat = $("#bformat").val();
        
        if (!hmaintitle) {
            alert("Report Title is Empty");
            return;
        }

        // Format based on the bar format
        var formatdata;
        if (bformat == "$") {
            formatdata = bformat + '{point.y:.1f}';
        } if(bformat == "€") {
            formatdata = bformat + '{point.y:.1f}';
        } else if (bformat == "%") {
            formatdata = '{point.y:.1f}' + bformat;
        } else {
            formatdata = '{point.y:.1f}';
        }

        // Function to generate a random color
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Assign colors dynamically if not provided or invalid
        var bardata = [];
        for (var i = 0; i < xcordinate.length; i++) {
            var color = barcol[i] || getRandomColor(); // Use provided color, else generate one
            var Headerbar = {
                name: xcordinate[i],
                y: barvalue[i],
                color: color
            }
            bardata.push(Headerbar);
        }

        // Highcharts configuration
        Highcharts.chart('bar_graphG', {
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
            subtitle: {
                text: hsubtitle,
                align: 'left',
                style: {
                    fontSize: '12px'
                }
            },
            xAxis: {
                categories: xcordinate,
                title: {
                    text: xcordtitle
                },
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ycordtitle,
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
                        enabled: true,
                        format: formatdata
                    }
                }
            },
            series: [{
                name: xcordtitle,
                data: bardata
            }]
        });
    });
});

</script>
<!--End Bar Graph -->

<!--Pie Chart-->
<script>
    $(document).ready(function() {
        $("#generate_pie_graph").click(function() {
            $("#pie_graphG").show();  // Show the pie chart container
            $("#pie-chart-graph").show();  // Show the script display area
            var chartId = 'pie<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
            $("#piescript").val('<div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Pie Script" class="graph_chart_view"> Pie Graph <?php echo $chartgraphcnt; ?> </div> </div></div>');

            // Retrieve form input values
            var hmaintitle = $("#headerpietitle").val();
            var pieoptions = $("#pieoption").val().split(',').map(function(item) {
                return item.trim();  // Trimming any extra spaces
            });
            var piepercentages = $("#pieoptioncount").val().split(',').map(Number);
            var piecolors = $("#pieoptioncol").val().split(',').map(function(item) {
                return item.trim();  // Trimming any extra spaces
            });

            // Validation to check if required fields are filled
            if (!hmaintitle) {
                alert("Header Title is empty");
                return;
            }
            if (!pieoptions.length || !piepercentages.length) {
                alert("Pie options and percentages are required");
                return;
            }
            if (pieoptions.length !== piepercentages.length) {
                alert("Pie options and percentages count mismatch");
                return;
            }

            // Create the data for the pie chart
            var seriesdata = [];
            for (var i = 0; i < pieoptions.length; i++) {
                seriesdata.push({
                    name: pieoptions[i],
                    y: piepercentages[i],
                    color: piecolors[i] || undefined  // Use default color if not provided
                });
            }

            // Highcharts configuration for pie chart
            Highcharts.chart('pie_graphG', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: hmaintitle,
                    align: 'left',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
                    style: {
                        fontSize: '12px'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                fontSize: '12px'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Percentage',
                    colorByPoint: true,
                    data: seriesdata
                }]
            });
        });
    });
</script>
<!--End Pie Chart-->
<!-- Point Chart Script -->
<script>
$(document).ready(function() {
    $("#generate_point_graph").click(function() {
        $("#point_graphG").show();
        $("#point-script-graph").show();
        var chartId = 'point<?php echo base64_decode($_GET["report_id"]) . $chartgraphcnt; ?>';
        $("#pointscript").val('<div class="text-center"><div class="position-relative p-4 mb-5 bg-white graph-img"> <div id="Point Script" class="graph_chart_view"> Point Graph <?php echo $chartgraphcnt; ?> </div> </div></div>');
        
        var hmaintitle = $("#headerpointtitle").val();
        var years = $("#pointyears").val().split(',').map(function(item) {
            return item.trim(); // Trimming any extra spaces
        });
        var yaxisTitle = $("#pointyaxisTitle").val();
        var northAmerica = $("#pointnorthAmerica").val().split(', ').map(Number);
        var latinAmerica = $("#pointlatinAmerica").val().split(', ').map(Number);
        var europe = $("#pointeurope").val().split(', ').map(Number);
        var asiaPacific = $("#pointasiaPacific").val().split(', ').map(Number);
        var middleEastA = $("#pointmiddleEastA").val().split(', ').map(Number);
        var bcol = $("#pointColor").val();
        var barDisplay = $("#pointDisplay").val();
        
        if (!hmaintitle) {
            alert("Report Title is Empty");
            return;
        }
    
    Highcharts.chart('point_graphG', {

    title: {
        text: hmaintitle,
        align: 'left',
        style: {
                    fontSize: '15px',
                    fontWeight: 'bold'
                }
    },

    yAxis: {
        title: {
            text: yaxisTitle
        }
    },

    xAxis: {
        categories: years,
        accessibility: {
            rangeDescription: 'Range: 2021 to 2033'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2021
        }
    },

    series: [{
                name: 'North America',
                data: northAmerica,
                color: '#015cd4'
            }, {
                name: 'Latin America',
                data: latinAmerica,
                color: '#0040b1'
            }, {
                name: 'Europe',
                data: europe,
                color: '#081975'
            }, {
                name: 'Asia Pacific',
                data: asiaPacific,
                color: '#2bc4f6'
            }, {
                name: 'Middle East & Africa',
                data: middleEastA,
                color: '#0003fa'
            }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
});
});
</script>
<!--End Point Chart-->