<?php 
require_once("classes/cls-graph.php");

$obj_graph = new Graph();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$field="*";
$report_id = base64_decode($_GET['report_id']);
$condition = "`report_id` = '" . $report_id . "'";
$graph_details = $obj_graph->getGraphDetails($field, $condition, '', '', 0);

$field="*";
$report_id = base64_decode($_GET['report_id']);
$condition = "`report_id` = '" . $report_id . "'";
$graphStacked_details = $obj_graph->getGraphStackedDetails($field, $condition, '', '', 0);
//print_r($graphStacked_details);
?>
<style>
    .highcharts-credits{ display:none;}
    .highcharts-button-symbol{ display:none;}
    .highcharts-legend-item{display:none};
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>
<div class="home-section">
   <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
            <div class="container">
                <div class="row d-flex align-items-center pb-3 light-bg">
                    <div class="col-md-12">
                        <h5 class="page-header">
                            <i class="icon-Dashboard"></i>
                            Graph List
                        </h5>
                    </div>
                </div>
                
            </div>
        </section>
        
<?php if(isset($graphStacked_details) && !empty($graphStacked_details)){ 
  $cnt = 1;  foreach($graphStacked_details as $stacked){
?>
<section class="common-space pt-3">
    <div class="container">
<form class="lead-info-form support-box-form p-0">
<div class="row">
   <div class="col-lg-12">
     <div class="form-group">
       <label><?php echo $cnt;?>) Script Of Stacked Bar Chart</label>
       <textarea class="form-control" style="height:33px;" readonly><?php echo $stacked['barscript'];?></textarea>
     </div>
   </div>
</div>
<div class="d-none"><?php echo $stacked['barscript'];?></div>
</form>
</div>
</section>

<?php $cnt++; } }else{ ?> 
<section class="common-space pt-3">
    <div class="container">
<form class="lead-info-form support-box-form p-0">
<div class="row">
   <div class="col-lg-12">
     <div class="form-group">
        <div>No Graphs Found</div>
   </div>
</div>
</form>
</div>
</section>
<?php } ?>
        
        
<?php $cnt=1;foreach($graph_details as $graph_detail)
{
    //echo $graph_detail['graph_type'];
?>

<?php if($graph_detail['graph_type']=="Bar Chart"){?>
<section class="common-space pt-3">
    <div class="container">
<form class="lead-info-form support-box-form p-0">
<div class="row">
   <div class="col-lg-12">
     <div class="form-group">
       <label><?php echo $cnt;?>) Script Of Bar Chart</label>
       <textarea class="form-control" style="height:33px;" readonly><?php echo $graph_detail['graph_script'];?></textarea>
     </div>
   </div>
</div>
<div><?php echo $graph_detail['graph_script'];?></div>
</form>
</div>
</section>
<script>
//Bar Chart Code
$( document ).ready(function() {

    var hmaintitle = "<?php echo $graph_detail['main_title'];?>";
    var hsubtitle = "<?php echo $graph_detail['sub_title'];?>";
    var xcordtitle = "<?php echo $graph_detail['x-coord-title'];?>";
    var ycordtitle = "<?php echo $graph_detail['y-coord-title'];?>";
    var xcord = "<?php echo $graph_detail['x-coordinate'];?>";
    var bval = "<?php echo $graph_detail['x-value'];?>";
    var bcol = "<?php echo $graph_detail['bar-value-color'];?>";
    var bformat = "<?php echo $graph_detail['bar-format'];?>";
    
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
            Highcharts.chart('bar'+<?php echo $graph_detail['chartid'];?>, {
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
});
//End Bar Chart Code
</script>
<?php }?>

<?php if($graph_detail['graph_type']=="Pie Chart"){?>
<section class="common-space pt-3">
    <div class="container">
<form class="lead-info-form support-box-form p-0">
<div class="row">
   <div class="col-lg-12">
     <div class="form-group">
       <label><?php echo $cnt;?>) Script Of Pie Chart</label>
       <textarea class="form-control" style="height:33px;" readonly><?php echo $graph_detail['graph_script'];?></textarea>
     </div>
   </div>
</div>
<div><?php echo $graph_detail['graph_script'];?></div>
</form>
</div>
</section>
<script>
//Pie Chart Code
$( document ).ready(function() {
            var headerpietitle = "<?php echo $graph_detail['main_title'];?>";
            var poption = "<?php echo $graph_detail['pie-option'];?>";
            var poptioncount = "<?php echo $graph_detail['pie-option-count'];?>";
            var pieoptioncol = "<?php echo $graph_detail['pie-option-color'];?>";
    
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
                Highcharts.chart('pie'+<?php echo $graph_detail['chartid'];?>, {
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

});
//End Pie Chart Code
</script>
<?php }?>

<?php if($graph_detail['graph_type']=="Point Chart"){?>
<section class="common-space pt-3">
    <div class="container">
<form class="lead-info-form support-box-form p-0">
<div class="row">
   <div class="col-lg-12">
     <div class="form-group">
       <label><?php echo $cnt;?>) Script Of Point Chart</label>
       <textarea class="form-control" style="height:33px;" readonly><?php echo $graph_detail['graph_script'];?></textarea>
     </div>
   </div>
</div>
<div><?php echo $graph_detail['graph_script'];?></div>
</form>
</div>
</section>
<script>
//Point Chart Code
$( document ).ready(function() {
            var headerpointtitle = "<?php echo $graph_detail['main_title'];?>";
            var headerpointsubtitle = "<?php echo $graph_detail['sub_title'];?>";
            var xcordpointtitle = "<?php echo $graph_detail['x-coord-title'];?>";
            var ycordpointtitle = "<?php echo $graph_detail['y-coord-title'];?>";
            var xcordpoint = "<?php echo $graph_detail['x-coordinate'];?>";
            var bvalpoint = "<?php echo $graph_detail['x-value'];?>";
            
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
                
                Highcharts.chart('point'+<?php echo $graph_detail['chartid'];?>, {
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

});
//End Point Chart Code
</script>
<?php }?>
<?php $cnt++;}?>

<?php include('footer.php')?>

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

