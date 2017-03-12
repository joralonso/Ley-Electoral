<?php require_once('./libs/funciones.php'); ?>
<!doctype html>
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/estilo.css" />
      <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
      <script src="js/vendor/modernizr.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>      
          <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {          
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
             colorAxis:  {minValue: 0, maxValue: 49,  colors: ['#01A9DB','#00FF00','#ACFA58','#F5BCA9','#ECCEF5','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#438094','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#DE3403','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E','#E0D39E']},
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
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <?php cabecera(); ?>      
    <div class="row">
      <div class="medium-12 columns">
        <h1>Sistema D'hondt</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut condimentum nunc ac urna mollis, vitae condimentum augue bibendum. Cras pulvinar felis lectus, sit amet posuere lectus posuere id. Morbi purus justo, dictum eget augue et, molestie sollicitudin urna. Ut ac sem felis. Morbi viverra rutrum nulla iaculis feugiat. Praesent vitae augue et nisl placerat sollicitudin sit amet sed augue. Vivamus et dui ante. Proin eu est at justo commodo tristique. Sed ac metus a ipsum vulputate pellentesque. Proin in diam nibh. Ut lacinia elit commodo, scelerisque ex ac, accumsan lacus. Etiam quis luctus ligula. Curabitur eget sapien tempus, molestie mi a, posuere nisl.
            Donec eleifend quis diam nec hendrerit. Nullam tempor semper ornare. Proin libero leo, ornare non volutpat id, varius in magna. Suspendisse quis consequat ex. Nullam vitae egestas felis. Aliquam aliquet nulla turpis, et porta dui maximus id. Suspendisse eu mauris vitae metus maximus porttitor id eu felis. Nam rhoncus nulla sodales nulla fringilla convallis. Ut tempus elementum facilisis.
            </p>
      </div>      
    </div>
      
    <div class="row">
        <div class="large-2 columns">
            &nbsp;
        </div>
      <div class="medium-8 columns">  
            <div id="regions_div" style="width: 900px; height: 500px;"></div> 
          <hr>
          <h3 class="titulo_resultados" id="generales">Compara los resultados de las elecciones con otro tipo de sistema</h3>
            <form action="sistemadhondt_1.php" method="GET">
                <div class="row">
                    <div class="large-3 columns">
                        <label>Año
                        <select name="year">
                            <option value="2011">2011</option>
                            <option value="2007">2007</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Comunidad
                        <select onchange="$('#municipio').html(''); $('#provincia').html(''); idCA=this.options[this.selectedIndex].value; if (this.options[this.selectedIndex].value.length>0) $('#provincia').load('./libs/getProvincias.php?comunidad=' + this.options[this.selectedIndex].value);" class="form-tipo2 comunidad2" id="comunidad" name="comunidad">
                            <option value="">Seleccione una</option><option value="01">Andalucía</option><option value="02">Aragón</option><option value="03">Asturias</option><option value="04">Baleares</option><option value="05">Canarias</option><option value="06">Cantabria</option><option value="07">Castilla La Mancha</option><option value="08">Castilla y León</option><option value="09">Cataluña</option><option value="18">Ceuta</option><option value="17">C. Valenciana</option><option value="10">Extremadura</option><option value="11">Galicia</option><option value="16">La Rioja</option><option value="12">Madrid</option><option value="19">Melilla</option><option value="15">Murcia</option><option value="13">Navarra</option><option value="14">País Vasco</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Provincia
                        <select onchange="$('#municipio').html(''); idProv=this.options[this.selectedIndex].value; if (this.options[this.selectedIndex].value.length>0) $('#municipio').load('./libs/getMunicipios.php?comunidad=' + idCA + '&provincia=' + this.options[this.selectedIndex].value )" name="provincia" id="provincia" class="form-tipo2">
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Municipio
                        <select onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" name="municipio" id="municipio" class="form-tipo2">
                        </select>
                        </label>
                    </div>
                </div>            
            </form>       
          
      </div>
        
        <div class="large-2 columns">
            &nbsp;
        </div>
    </div>
      
    <div class="row">
        <div class="large-1 columns">
            &nbsp;
        </div>
        <div class="large-10 columns">
            <div id="container" style="with=100%"></div>     
        </div>
        <div class="large-1 columns">
           &nbsp; 
        </div>
    </div>
    
      
    <footer>
        <hr>
        <h5 style="text-align:center;">Jorge Alonso Merchán - IPO USAL 2015</h5>
    </footer>
    
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
