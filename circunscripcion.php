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
      <script src="http://code.highcharts.com/maps/highmaps.js"></script>
    <script src="http://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="http://code.highcharts.com/mapdata/countries/es/es-all.js"></script>

      <script type="text/javascript">
            $(function () {

                // Prepare demo data
                var data = [
                    {
                        "hc-key": "es-pm",
                        "value": 8,
                    },
                    {
                        "hc-key": "es-va",
                        "value": 5
                    },
                    {
                        "hc-key": "es-me",
                        "value": 1
                    },
                    {
                        "hc-key": "es-p",
                        "value": 3
                    },
                    {
                        "hc-key": "es-s",
                        "value": 5
                    },
                    {
                        "hc-key": "es-na",
                        "value": 5
                    },
                    {
                        "hc-key": "es-ce",
                        "value": 1
                    },
                    {
                        "hc-key": "es-cu",
                        "value": 3
                    },
                    {
                        "hc-key": "es-vi",
                        "value": 4
                    },
                    {
                        "hc-key": "es-ss",
                        "value": 6
                    },
                    {
                        "hc-key": "es-gr",
                        "value": 7
                    },
                    {
                        "hc-key": "es-mu",
                        "value": 10
                    },
                    {
                        "hc-key": "es-sa",
                        "value": 4
                    },
                    {
                        "hc-key": "es-le",
                        "value": 5
                    },
                    {
                        "hc-key": "es-za",
                        "value": 3
                    },
                    {
                        "hc-key": "es-m",
                        "value": 36
                    },
                    {
                        "hc-key": "es-gu",
                        "value": 3
                    },
                    {
                        "hc-key": "es-sg",
                        "value": 3
                    },
                    {
                        "hc-key": "es-se",
                        "value": 12
                    },
                    {
                        "hc-key": "es-te",
                        "value": 3
                    },
                    {
                        "hc-key": "es-v",
                        "value": 16
                    },
                    {
                        "hc-key": "es-bu",
                        "value": 4
                    },
                    {
                        "hc-key": "es-bi",
                        "value": 8
                    },
                    {
                        "hc-key": "es-or",
                        "value": 4
                    },
                    {
                        "hc-key": "es-l",
                        "value": 4
                    },
                    {
                        "hc-key": "es-z",
                        "value": 7
                    },
                    {
                        "hc-key": "es-t",
                        "value": 6
                    },
                    {
                        "hc-key": "es-lo",
                        "value": 4
                    },
                    {
                        "hc-key": "es-gi",
                        "value": 6
                    },
                    {
                        "hc-key": "es-ab",
                        "value": 4
                    },
                    {
                        "hc-key": "es-a",
                        "value": 12
                    },
                    {
                        "hc-key": "es-av",
                        "value": 3
                    },
                    {
                        "hc-key": "es-cc",
                        "value": 4
                    },
                    {
                        "hc-key": "es-cr",
                        "value": 5
                    },
                    {
                        "hc-key": "es-ba",
                        "value": 6
                    },
                    {
                        "hc-key": "es-to",
                        "value": 6
                    },
                    {
                        "hc-key": "es-co",
                        "value": 6
                    },
                    {
                        "hc-key": "es-ma",
                        "value": 10
                    },
                    {
                        "hc-key": "es-h",
                        "value": 5
                    },
                    {
                        "hc-key": "es-hu",
                        "value": 3
                    },
                    {
                        "hc-key": "es-c",
                        "value": 8
                    },
                    {
                        "hc-key": "es-po",
                        "value": 7
                    },
                    {
                        "hc-key": "es-al",
                        "value": 6
                    },
                    {
                        "hc-key": "es-b",
                        "value": 31
                    },
                    {
                        "hc-key": "es-ca",
                        "value": 8
                    },
                    {
                        "hc-key": "es-o",
                        "value": 8
                    },
                    {
                        "hc-key": "es-cs",
                        "value": 5
                    },
                    {
                        "hc-key": "es-j",
                        "value": 6
                    },
                    {
                        "hc-key": "es-so",
                        "value": 2
                    },
                    {
                        "hc-key": "es-lu",
                        "value": 4
                    },
                    {
                        "hc-key": "es-tf",
                        "value": 7
                    },
                    {
                        "hc-key": "es-gc",
                        "value": 8
                    },
                    {
                        "value": 52
                    }
                ];

                // Initiate the chart
                $('#container').highcharts('Map', {

                    title : {
                        text : 'Highmaps basic demo'
                    },

                    subtitle : {
                        text : 'Source map: <a href="http://code.highcharts.com/mapdata/countries/es/es-all.js">Spain</a>'
                    },

                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },

                    colorAxis: {
                            min: 1,
                            max: 36,
                            type: 'logarithmic',
                            minColor: '#EEF7FF',
                            maxColor: '#001930',
                            /*stops: [
                               // [1,  '#AAd6FF'],
                                [16, '#0B59A2'],
                                [31, '#0C3E6D'],
                                [36, '#0B3861']
                            ]*/
                        },

                    series : [{
                        data : data,
                        mapData: Highcharts.maps['countries/es/es-all'],
                        joinBy: 'hc-key',
                        name: 'Random data',
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        },             
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }, {
                        name: 'Separators',
                        type: 'mapline',
                        data: Highcharts.geojson(Highcharts.maps['countries/es/es-all'], 'mapline'),
                        color: 'silver',
                        showInLegend: false,
                        enableMouseTracking: false
                    }]
                });
            });

      </script>
  </head>
  <body>
    <?php cabecera(); ?>      
    <div class="row">
      <div class="medium-12 columns">
        <h1>Circunscripciones</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut condimentum nunc ac urna mollis, vitae condimentum augue bibendum. Cras pulvinar felis lectus, sit amet posuere lectus posuere id. Morbi purus justo, dictum eget augue et, molestie sollicitudin urna. Ut ac sem felis. Morbi viverra rutrum nulla iaculis feugiat. Praesent vitae augue et nisl placerat sollicitudin sit amet sed augue. Vivamus et dui ante. Proin eu est at justo commodo tristique. Sed ac metus a ipsum vulputate pellentesque. Proin in diam nibh. Ut lacinia elit commodo, scelerisque ex ac, accumsan lacus. Etiam quis luctus ligula. Curabitur eget sapien tempus, molestie mi a, posuere nisl.
            Donec eleifend quis diam nec hendrerit. Nullam tempor semper ornare. Proin libero leo, ornare non volutpat id, varius in magna. Suspendisse quis consequat ex. Nullam vitae egestas felis. Aliquam aliquet nulla turpis, et porta dui maximus id. Suspendisse eu mauris vitae metus maximus porttitor id eu felis. Nam rhoncus nulla sodales nulla fringilla convallis. Ut tempus elementum facilisis.
            </p>
            <div id="container" style="with=100%"></div>  
      </div>      
    </div>
      
    <div class="row">
        <div class="large-2 columns">
            &nbsp;
        </div>
      <div class="medium-8 columns">  
          <hr>
          <h3 class="titulo_resultados" id="generales">Compara los resultados de las elecciones con otro tipo de circunscripción</h3>
            <form action="circunscripcion_1.php" method="GET">
                <div class="row">
                    <div class="large-6 columns">
                        <label>Año
                        <select name="year">
                            <option value="2011">2011</option>
                            <option value="2008">2008</option>
                            <option value="2004">2004</option>
                            <option value="2000">2000</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-6 columns">
                        <label>Lugar
                        <select onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" name="sitio">
                            <option value="">Seleccione una</option>
                            <option value="congreso">Congreso</option>
                            <option value="senado">Senado</option>
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
