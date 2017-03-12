<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
          /*
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Value', 'Color', {role: 'tooltip', p:{html:true}}],
            ['Germany', 'DHONT', '#0000ff', 'Alemania'],
            ['ES', 'NO', '#0000ff','ESPAÑA']
        ]);
*/
          
          var data = new google.visualization.DataTable();

          data.addColumn('string', 'Country');
          data.addColumn('number', 'Escaños'); 
          data.addRows([[{v: 'ES-C'},1]]);
          data.addRows([[{v: 'ES-VI'},2]]);
          data.addRows([[{v: 'ES-AB'},3]]);
          
          
         var options = {
             //backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },
             //legend: 'none',    
             //backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },    
            // datalessRegionColor: '#f5f5f5',
            // displayMode: 'regions', 
            // enableRegionInteractivity: 'true', 
            // sizeAxis: {minValue: 1, maxValue:1,minSize:10,  maxSize: 10},
             region:'ES',
             'resolution':'provinces',
           //  keepAspectRatio: true,
             width:600,
             height:400,
            // tooltip: {textStyle: {color: '#444444'}, trigger:'hover'}  
        };
        var chart = new google.visualization.GeoChart(document.getElementById('regions_div')); 
          
          /*
        var options = {
          region: 'US', // Africa
          colorAxis: {colors: ['#00853f', 'black', '#e31b23']},
          backgroundColor: '#81d4fa',
          datalessRegionColor: '#f8bbd0',
          defaultColor: '#f5f5f5',
          legend:{position:'none'}
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
*/
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="regions_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>