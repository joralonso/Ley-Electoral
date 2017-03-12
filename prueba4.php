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
          data.addColumn('number', 'Value'); 
          data.addColumn({type:'string', role:'tooltip'});var ivalue = new Array();
          data.addRows([[{v:'AT'},0,'Austria: Sistema D\'hont']]);
          data.addRows([[{v:'BE'},0,'Bélgica. Sistema D\'hont']]);
          data.addRows([[{v:'BG'},0,'Bulgaria. Sistema D\'hont']]);
          data.addRows([[{v:'HR'},0,'Croacia: Sistema D\'hont']]);
          data.addRows([[{v:'SI'},0,'Eslovenia: Sistema D\'hont']]);
          data.addRows([[{v:'ES'},0,'España: Sistema D\'hont']]);
          data.addRows([[{v:'FI'},0,'Finlandia: Sistema D\'hont']]);
          data.addRows([[{v:'FR'},0,'Francia: Sistema D\'hont']]);
          data.addRows([[{v:'NL'},0,'Paises Bajos: Sistema D\'hont']]);
          data.addRows([[{v:'PL'},0,'Polonia: Sistema D\'hont']]);
          data.addRows([[{v:'PT'},0,'Portugal: Sistema D\'hont']]);
          data.addRows([[{v:'CZ'},0,'Republica Checa: Sistema D\'hont']]);
          data.addRows([[{v:'CH'},0,'Suiza: Sistema D\'hont']]);
          data.addRows([[{v:'GB'},0,'Suiza: Sistema D\'hont']]);
          
          
          data.addRows([[{v:'DE'},2,'Alemania: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'NO'},2,'Noruega: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'SE'},2,'Suecia: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'DK'},2,'Dinamarca: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'BA'},2,'Bosnia Herzegovina: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'LV'},2,'Letonia: Sistema Sainte-Laguë']]);
          data.addRows([[{v:'KO'},2,'Kosovo: Sistema Sainte-Laguë']]);
          
          data.addRows([[{v:'CY'},3,'Chipre: Sistema Hare-Niemeyer']]);
          data.addRows([[{v:'GR'},3,'Grecia: Sistema Hare-Niemeyer']]);
          data.addRows([[{v:'IT'},3,'Italia: Sistema Hare-Niemeyer']]);
          data.addRows([[{v:'LT'},3,'Lituania: Sistema Hare-Niemeyer']]);
          
          data.addRows([[{v:'IE'},4,'Lituania: Sistema DROOP']]);
          data.addRows([[{v:'MT'},4,'Lituania: Sistema DROOP']]);
          data.addRows([[{v:'SK'},4,'Lituania: Sistema DROOP']]);
          
          
          
         var options = {
             backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },
             colorAxis:  {minValue: 0, maxValue: 49,  colors: ['#0000FF','#00FF00','#FF0000','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E']},
             legend: 'none',    
             backgroundColor: {fill:'#FFFFFF',stroke:'#FFFFFF' ,strokeWidth:0 },    
             datalessRegionColor: '#f5f5f5',
             displayMode: 'regions', 
             enableRegionInteractivity: 'true', 
             sizeAxis: {minValue: 1, maxValue:1,minSize:10,  maxSize: 10},
             region:150,
             keepAspectRatio: true,
             width:600,
             height:400,
             tooltip: {textStyle: {color: '#444444'}, trigger:'hover'}  
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