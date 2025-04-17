<?php 
require_once("precedence/classes/cls-graph.php");

$obj_graph = new Graph();


$field_graph="*";
$report_ids = $report_detail_specific['report_id'];
$condition_graph = "`predr_graph`.`report_id` = '" . $report_ids . "'";
$graph_details = $obj_graph->getGraphDetails($field_graph, $condition_graph, '', '', 0);
//print_r($graph_details);
?>
<style>
    .highcharts-credits, .highcharts-exporting-group{display:none;}
    .highcharts-legend{pointer-events:none}
</style>
<?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?php endif; ?>
<!-- Stacked Graph-->
<script>
    $(document).ready(function(){
        // Get the encoded JSON data from the hidden div
        var encodedData = document.getElementById('stackedGraphData').textContent;

        // Decode and parse the JSON data
        var graphDetails = JSON.parse(atob(encodedData));

        // Loop through the graphDetails and initialize Highcharts
        graphDetails.forEach(function(graphDetail, index) {
            var decodedData = {
                report_id: graphDetail.report_id,
                reportTitle: graphDetail.reportTitle,
                years: graphDetail.years.split(',').map(item => item.trim()),
                yaxisTitle: graphDetail.yaxisTitle,
                northAmerica: graphDetail.northAmerica.split(', ').map(Number),
                latinAmerica: graphDetail.latinAmerica.split(', ').map(Number),
                europe: graphDetail.europe.split(', ').map(Number),
                asiaPacific: graphDetail.asiaPacific.split(', ').map(Number),
                middleEastA: graphDetail.middleEastA.split(', ').map(Number)
            };
             var chartId = decodedData.report_id + graphDetail.chartid;
             console.log(chartId);
            Highcharts.chart(chartId, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: decodedData.reportTitle,
                    align: 'left',
                    style: {
                        fontSize: '15px',
                        fontWeight: 'bold'
                    }
                },
                xAxis: {
                    categories: decodedData.years,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: decodedData.yaxisTitle,
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
                    enabled: false,  // Disable the tooltip
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
                    data: decodedData.northAmerica,
                    color: '#00715D'
                }, {
                    name: 'Latin America',
                    data: decodedData.latinAmerica,
                    color: '#C99764'
                }, {
                    name: 'Europe',
                    data: decodedData.europe,
                    color: '#FDB139'
                }, {
                    name: 'Asia Pacific',
                    data: decodedData.asiaPacific,
                    color: '#FDD65B'
                }, {
                    name: 'Middle East & Africa',
                    data: decodedData.middleEastA,
                    color: '#C5D8CA'
                }]
            });
        });

        // Add click event for the Access Button
        $('.access-btn').click(function() {
            alert('Access Data button clicked!');
            // You can add your custom logic here, such as redirecting or displaying additional data
        });
    });
</script>
<!-- End Stacked Graph -->
