<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          ["King's pawn (e4)", 31],
          ["Queen's pawn (d4)", 44],
          ["Knight to King 3 (Nf3)", 12],
          ["Queen's bishop pawn (c4)", 10],
          ['Other', 3]
        ]); 

        var options = {
          title: 'Chess opening moves',
          width: 1000,
          colors: ['blue'],
          legend: { position: 'none' },
          chart: { title: 'Chess opening moves',
                   subtitle: 'popularity by percentage' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'bottom', label: 'Percentage'} // bottom x-axis.
            },
            y: {
              0: { side: 'left', label: 'Opening Move'} // left x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>
  </body>
  
  <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Copper", 8.94, "#b87333"],
        ["Silver", 10.49, "silver"],
        ["Gold", 19.30, "gold"],
        ["Platinum", 21.45, "color: #e5e4e2"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        bars: 'vertical',
        axes: {
            x: {
              0: { side: 'bottom', label: 'Percentage'} // bottom x-axis.
            },
            y: {
              0: { side: 'left', label: 'Opening Move'} // left x-axis.
            }
          },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="barchart_values" style="width: 900px; height: 300px;"></div>
</html>


<html>
   <head>
      <title>Google Charts Tutorial</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart','line']});  
      </script>
   </head>

   <body>
      <div id = "container" style = "width: 900px; height: 500px; margin: 0 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Tokyo');
           
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
               'width':900,
               'height':500,
               pointsVisible: true	  
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
   </body>
</html>

