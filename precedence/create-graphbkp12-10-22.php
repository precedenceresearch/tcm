<?php
require_once("classes/cls-graph.php");

$obj_graph = new Graph();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
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
                                       
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Graph Type</label>
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="graph" id="bargraph" value="Bar Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Bar Chart
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                             <div class="radio">
                                              <label class="padding-0">
                                             <input type="radio" name="graph" id="piegraph" value="Pie Chart">
                                             <span class="cr"><i class="cr-icon fa fa-check"></i></span>Pie Chart
                                             </label>
                                             </div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
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
                                        <div class="form-group text-center pt-3">
                                             <button type="button" class="btn s-btn col-md-12" id="generate_bar_graph" name="generate_bar_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                        
                                        </div>
                                        </div>
                                        
                                        
                                        </div>
                                        <div class="col-md-12 pt-4" id="bar-chart-graph" style="display:none;">
                                         <div id="bar<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>" style="width: 900px; height: 500px;"></div>
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
                                             <label>Pie Options (Comma Separated Values) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoption" id="pieoption" placeholder="Pie Options " value="">
                                             <div class="star" id="pieoption_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Pie Options Count (Comma Separated Values) <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="pieoptioncount" id="pieoptioncount" placeholder="Pie Options Count " value="">
                                             <div class="star" id="pieoptioncount_error_message"></div>
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Pie Options Colors (Comma Separated Values)</label>
                                             <input type="text" class="form-control" name="pieoptioncol" id="pieoptioncol" placeholder="Pie Options Colors " value="">
                                             
                                        </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        <div class="form-group text-center pt-3">
                                             <button type="button" class="btn s-btn col-md-12" id="generate_pie_graph" name="generate_pie_graph">Generate Graph(Click Button To Visualise Your Graph)</button>
                                        
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-12 pt-4" id="pie-chart-graph" style="display:none;">
                                         <div id="pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>" style="width: 900px; height: 450px;"></div>
                                         <div class="form-group" style="padding-top:20px;">
                                             <label>Script For Pie Chart</label>
                                             <textarea id="piescript" name="piescript" class="form-control" style="height:33px;" readonly></textarea>
                                         </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!--Point Chart-->
                                    <div id="point-chart" style="display:none;">
                                        <div id="point" style = "width: 1000px; height: 500px; margin: 0 auto"></div>

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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script language = "JavaScript">
$( document ).ready(function() {
    
//Radio options for different graph
    $("#bargraph").click(function(){
       $("#bar-chart").show();
       $("#pie-chart").hide();
       $("#point-chart").hide();
    })
    
    $("#piegraph").click(function(){
       $("#bar-chart").hide();
       $("#pie-chart").show();
       $("#point-chart").hide();
    })
    
    $("#pointgraph").click(function(){
       $("#bar-chart").hide();
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
            
    var xcordtitle_error_message = false;
    var ycordtitle_error_message = false;
    var xcord_error_message = false;
    var bval_error_message = false;
    
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
//End Validation Code of bar chart 


//Bar graph generation code    
    $("#generate_bar_graph").click(function(){
       var xcordtitle = $("#xcordtitle").val();
       var ycordtitle = $("#ycordtitle").val();
       var xcord = $("#xcord").val();
       var bval = $("#bval").val();
       //var bcol = $("#bcol").val();
       check_xcordtitle(); 
       check_ycordtitle(); 
       check_xcord(); 
       check_bval(); 
       
    
       if(bval_error_message === false && xcord_error_message === false && ycordtitle_error_message === false && xcordtitle_error_message === false)
       {
            $("#bar-chart-graph").show();
            //google.charts.setOnLoadCallback(drawBarChart);
            drawBarChart(xcordtitle,ycordtitle,xcord,bval);
            $("#barscript").val("<div id='bar<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' style='width: 900px; height: 500px;'></div><br><input type='hidden' value='<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' id='chartid' name='chartid'>");
            $('#btn_submit').prop('disabled', false);
       }
    })
//End Bar graph generation code  
});
//Bar Chart Code
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawBarChart);


      function drawBarChart(xcordtitle,ycordtitle,xcord,bval) {
        
        var newarray=[];
        var xcordinate = xcord.split(",");
        var barvalue = bval.split(",");
        //var barcolor = bcol.split(",");
        
        if(xcordinate.length > 0)
        {
             
             var data=[];
             var Header= ["'"+ycordtitle+"'", "'"+xcordtitle+"'"];
             data.push(Header);
             for(var i = 0; i < xcordinate.length; i++)
             {
                var Header = [xcordinate[i], parseInt(barvalue[i])];
                data.push(Header);
                  
             }
             var cdata = new google.visualization.arrayToDataTable(data);
           
            var options = {
              title: '',
              width: 900,
              legend: { position: 'none' },
              chart: { title: '',
                   subtitle: '' },
              bars: 'vertical', // Required for Material Bar Charts.
              axes: {
                x: {
                  0: { side: 'bottom', label: xcordtitle} // bottom x-axis.
                },
                y: {
                  0: { side: 'left', label: ycordtitle} // left x-axis.
                }
              },
              bar: { groupWidth: "60%" },
              colors: ['#232d64']
            };
    
            var chart = new google.charts.Bar(document.getElementById('bar'+<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>));
            chart.draw(cdata, options);
        }
      }
//End Bar Chart Code
</script>

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
        
       var poption = $("#pieoption").val();
       var poptioncount = $("#pieoptioncount").val();
       var pieoptioncol = $("#pieoptioncol").val();
       check_pieoption(); 
       check_pieoptioncount(); 
       
    
       if(pieoptioncount_error_message === false && pieoption_error_message === false)
       {
            $("#pie-chart-graph").show();
            //google.charts.setOnLoadCallback(drawBarChart);
            drawPieChart(poption,poptioncount,pieoptioncol);
            $("#piescript").val("<div id='pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' style='width: 900px; height: 450px;'></div><br><input type='hidden' value='<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' id='chartid' name='chartid'>");
            $('#btn_submit').prop('disabled', false);
       }
    })
//End Pie chart generation code  
});

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawPieChart);
      
      function drawPieChart(poption,poptioncount,pieoptioncol) {
            var poptions = poption.split(",");
            var poptioncounts = poptioncount.split(",");
            
             var data1=[];
             var Header1= ['Pie', 'Counts'];
             data1.push(Header1);
             for(var j = 0; j < poptions.length; j++)
             {
                  
                  var Header1 = [poptions[j], parseInt(poptioncounts[j])];
                  data1.push(Header1);
                 
              }
              
              //alert(data);
              
             
            var pdata = new google.visualization.arrayToDataTable(data1);

            if(pieoptioncol!="")
             {
                 var pieoptioncols = pieoptioncol.split(",");
                 var options = {
                      title: '',
                      width:900,
                      height:450,
                      is3D: true,
                      pieSliceText: 'label',
                      legend: { position: "none" },
                      titleTextStyle: {
                            color: '#cc00cc',    // any HTML string color ('red', '#cc00cc')
                            fontName: 'Circular Std', // i.e. 'Times New Roman'
                            fontSize: '14', // 12, 18 whatever you want (don't specify px)
                            bold: 'true',    // true or false
                            italic: 'false',  // true of false
                            backgroundColor:'transparent'
                        },
                       colors: pieoptioncols 
                     };
             }
             else
             {
                var options = {
                  title: '',
                  width:900,
                  height:450,
                  is3D: true,
                  pieSliceText: 'label',
                  legend: { position: "none" },
                  titleTextStyle: {
                        color: '#cc00cc',    // any HTML string color ('red', '#cc00cc')
                        fontName: 'Circular Std', // i.e. 'Times New Roman'
                        fontSize: '14', // 12, 18 whatever you want (don't specify px)
                        bold: 'true',    // true or false
                        italic: 'false',  // true of false
                        backgroundColor:'transparent'
                    }
                    
                 };
             }
             
           
            var chart = new google.visualization.PieChart(document.getElementById('pie'+<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>));
            chart.draw(pdata, options);
      }

</script>
<!--End Pie Chart-->

<!--//Point Chart-->
<script language = "JavaScript">
$( document ).ready(function() {
   
    
   //Point chart generation code    
    $("#generate_point_graph").click(function(){
        
      
       
    
       
            $("#point-chart-graph").show();
            //google.charts.setOnLoadCallback(drawBarChart);
            drawPointChart(poption,poptioncount,pieoptioncol);
            $("#pointscript").val("<div id='pie<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' style='width: 900px; height: 450px;'></div><br><input type='hidden' value='<?php echo base64_decode($_GET['report_id']).$chartgraphcnt;?>' id='chartid' name='chartid'>");
            $('#btn_submit').prop('disabled', false);
      
    })
//End Point chart generation code  
});

      google.charts.load('current', {packages: ['corechart','line']});
      
      function drawPointChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Temperature');
           
            data.addRows([
               ['Jan',  7.0],
               ['Feb',  6.9],
               ['Mar',  9.5],
               ['Apr',  14.5],
               ['May',  18.2],
               ['Jun',  21.5],
               
               ['Jul',  25.2],
               ['Aug',  26.5],
               ['Sep',  23.3],
               ['Oct',  18.3],
               ['Nov',  13.9],
               ['Dec',  9.6]
            ]);
               
            // Set chart options
            var options = {'title' : 'Average Temperatures of Cities',
               hAxis: {
                  title: 'Month'
               },
               vAxis: {
                  title: 'Temperature'
               },   
               'width':1000,
               'height':500,
               pointsVisible: true	  
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('point'));
            chart.draw(data, options);
         }
         
google.charts.setOnLoadCallback(drawPointChart);

</script>
<!--End Point Chart-->