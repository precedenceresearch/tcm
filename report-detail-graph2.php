<style>
    .highcharts-credits, .highcharts-exporting-group{display:none;}
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
                        fontSize: '12px',
                        cursor: 'default',  // Disable the pointer cursor
                        color: '#000' // Optional: Set a custom color for legend items
                    },
                    itemHoverStyle: {
                        color: '#000', // Disable hover color change
                    },
                    useHTML: true // Ensure the legend is rendered as plain HTML
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
                    },
                    series: {
                        states: {
                            hover: {
                                enabled: false // Disable hover effect
                            },
                            inactive: {
                                enabled: false // Prevent other series from dimming on hover
                            }
                        },
                        point: {
                            events: {
                                mouseOver: function() {
                                    this.setState(''); // Remove hover state on individual points
                                }
                            }
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

<style>
    .highcharts-axis-labels.highcharts-xaxis-labels text {
        fill: #333333 !important; /* Change the color of X-axis labels */
    }
</style>

<script>
$(document).ready(function(){
    
    // Get the encoded JSON data from the hidden div
    var encodedbarData = document.getElementById('barGraphData').textContent;

    // Decode and parse the JSON data
    var barGraphDetails = JSON.parse(atob(encodedbarData));

    // Loop through the barGraphDetails and initialize Highcharts for each chart
    barGraphDetails.forEach(function(barDetail, index) {
        var decodedbarData = {
                report_id: barDetail.report_id,
                reportTitle: barDetail.main_title,
                xCoordTitle: barDetail['x-coord-title'],
                yCoordTitle: barDetail['y-coord-title'],
                xCoordinate: barDetail['x-coordinate'].split(',').map(item => item.trim()),
                xValue: barDetail['x-value'].split(',').map(Number),
                barColor: barDetail['bar-value-color'].split(',').map(item => item.trim())  // Extract colors
        };
        
        // Dynamically assign a chart ID
        var barChartId = decodedbarData.report_id + barDetail.chartid;

        Highcharts.chart(barChartId, {
            chart: {
                type: 'column'  // This ensures vertical columns
            },
            title: {
                text: decodedbarData.reportTitle,
                align: 'left',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold'
                }
            },
            xAxis: {
                categories: decodedbarData.xCoordinate,
                title: {
                    text: decodedbarData.xCoordTitle,
                    style: {
                        fontSize: '14px'
                    },
                    offset: 50  // Add margin below the X-axis title
                },
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#333333'  // Set X-axis label color to #333333
                    }
                }
            },
            yAxis: {
                title: {
                    text: decodedbarData.yCoordTitle,
                    style: {
                        fontSize: '14px'
                    },
                    offset: 40  // Add margin between Y-axis title and the axis labels
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                enabled: false,  // Disable the tooltip
                formatter: function() {
                    return false; // Ensure tooltips are never shown
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: false  // Disable data labels to hide bar values
                    }
                }
            },
            series: [{
                name: decodedbarData.yCoordTitle,
                colorByPoint: true,  // Enables per-point color
                data: decodedbarData.xCoordinate.map((name, i) => ({
                    name: name,
                    y: decodedbarData.xValue[i],
                    color: decodedbarData.barColor[i],  // Assigns color dynamically to each bar
                    drilldown: name // Link drilldown to the category name if required
                }))
            }],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: barDetail.drilldownData // Use appropriate drilldown data here
            }
          });
    });
});
</script>



<!-- Column Graph-->
<script>
$(document).ready(function(){
    
        // Get the encoded JSON data from the hidden div
        var encodedColumnData = document.getElementById('columnGraphData').textContent;

        // Decode and parse the JSON data
        var columnGraphDetails = JSON.parse(atob(encodedColumnData));

        // // Loop through the columnGraphDetails and initialize Highcharts for each chart
        columnGraphDetails.forEach(function(columnDetail, index) {
            var decodedColumnData = {
                    report_id: columnDetail.report_id,
                    reportTitle: columnDetail.columnreportTitle,
                    columnyaxisTitle1: columnDetail.columnyaxisTitle1,
                    columnyaxisTitle2: columnDetail.columnyaxisTitle2,
                    columnXAxis: columnDetail.columnXAxis.split(',').map(item => item.trim()),
                    yaxis1Value: columnDetail.yaxis1Value.split(', ').map(Number),
                    yaxis2Value: columnDetail.yaxis2Value.split(', ').map(Number)
            };
            
            // Dynamically assign a chart ID
            var columnChartId = decodedColumnData.report_id + columnDetail.chartid;
    
        Highcharts.chart(columnChartId, {
            chart: {
                type: 'column'
            },
            title: {
                text: decodedColumnData.reportTitle,
                align: 'left',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold'
                }
            },
            xAxis: {
                categories: decodedColumnData.columnXAxis,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yAxis: [{
                min: 0,
                title: {
                    text: decodedColumnData.columnyaxisTitle1,
                    style: {
                        fontSize: '14px'
                    }
                }
            }, {
                min: 0,
                title: {
                    text: decodedColumnData.columnyaxisTitle2,
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
                name: decodedColumnData.columnyaxisTitle1,
                data: decodedColumnData.yaxis1Value,
                yAxis: 0
            }, {
                name: decodedColumnData.columnyaxisTitle2,
                data: decodedColumnData.yaxis2Value,
                yAxis: 1
            }]
          });
        });
    });
</script>
<!-- End Column Graph-->

<!-- Point Graph-->
<script>
$(document).ready(function() {
    
     // Get the encoded JSON data from the hidden div
        var encodedPointData = document.getElementById('pointGraphData').textContent;

        // Decode and parse the JSON data
        var pointGraphDetails = JSON.parse(atob(encodedPointData));

        // // Loop through the columnGraphDetails and initialize Highcharts for each chart
        pointGraphDetails.forEach(function(pointDetail, index) {
            var decodedPointData = {
                    report_id: pointDetail.report_id,
                    years: pointDetail.years.split(',').map(item => item.trim()),
                    reportTitle: pointDetail.reportTitle,
                    yaxisTitle: pointDetail.yaxisTitle,
                    northAmerica: pointDetail.northAmerica.split(', ').map(Number),
                    latinAmerica: pointDetail.latinAmerica.split(', ').map(Number),
                    europe: pointDetail.europe.split(', ').map(Number),
                    asiaPacific: pointDetail.asiaPacific.split(', ').map(Number),
                    middleEastA: pointDetail.middleEastA.split(', ').map(Number)
            };
            
            // Dynamically assign a chart ID
            var pointChartId = decodedPointData.report_id + pointDetail.chartId;
            
            console.log(pointChartId);
                Highcharts.chart(pointChartId, {
                title: {
                    text: decodedPointData.reportTitle,
                    align: 'left'
                },
            
                yAxis: {
                    title: {
                        text: decodedPointData.yaxisTitle
                    }
                },
            
                xAxis: {
                    categories: decodedPointData.years,
                    accessibility: {
                        rangeDescription: 'Range: 2021 to 2033'
                    }
                },
            
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                tooltip: {
                    enabled: false // Disable the tooltip completely
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
<!-- End Point Graph-->

<!-- Pie Graph-->
<script>
    $(document).ready(function(){
        
        // Get the encoded JSON data from the hidden div
        var encodedPieData = document.getElementById('pieGraphData').textContent;

        // Decode and parse the JSON data
        var pieGraphDetails = JSON.parse(atob(encodedPieData));

        // Loop through the pieGraphDetails and initialize Highcharts for each chart
        pieGraphDetails.forEach(function(pieDetail, index) {
            var decodedPieData = {
                report_id: pieDetail.report_id,
                main_title: pieDetail.main_title,
                pieoptions: pieDetail.pieoptions.split(',').map(item => item.trim()), // Ensure options are trimmed
                piepercentages: pieDetail.piepercentages.split(',').map(Number), // Convert percentages to numbers
                piecolors: pieDetail.piecolors ? pieDetail.piecolors.split(',').map(item => item.trim()) : [] // Handle colors if available
            };
            
            // Dynamically assign a chart ID
            var pieChartId = decodedPieData.report_id + pieDetail.chartid;

            // Create the data for the pie chart
            var seriesdata = [];
            for (var i = 0; i < decodedPieData.pieoptions.length; i++) {
                seriesdata.push({
                    name: decodedPieData.pieoptions[i],
                    y: decodedPieData.piepercentages[i],
                    color: decodedPieData.piecolors[i] || undefined  // Use default color if not provided
                });
            }

            // Highcharts configuration for pie chart
            Highcharts.chart(pieChartId, {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: decodedPieData.main_title,
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
                            enabled: true, // Enable data labels
                            format: '<b>{point.name}</b>', // Show only the name without the value
                            style: {
                                fontSize: '12px'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Options',
                    colorByPoint: true,
                    data: seriesdata
                }]
            });
        });
    });
</script>
<!-- End Pie Graph-->