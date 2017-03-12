<?php

require_once('./libs/funciones.php');

if (isset($_GET['provincia'])) {
    $provincia = explode('-', $_GET['provincia']);
    /*
    $provincia = $ar[0];
    if (isset($ar[1]))$comunidad = $ar[1];
    else $comunidad = 10;*/
}
else {
    $provincia = 10;
    $comunidad = 10;    
}

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}else{
    $tipo = 'autonomicas';
}

if ($tipo == 'generales'){
    if (isset($_GET['tipo2'])) {
    $tipo2 = $_GET['tipo2'];
    }else{
        $tipo2 = 'congreso';
    }
    $tipo .= '/'.$tipo2;
}

if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
else{
    $year = 2011;
}


$xml=simplexml_load_file('http://resultados.elpais.com/elecciones/'.$year.'/'.$tipo.'/'.implode('/', $provincia).'.xml2') or die("Error: Cannot create object");

foreach ($xml->resultados->partido as $p){
    
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['color'] = setColor($p->nombre);
    $color = $a['color'];
    
    if ($p->electos > 0){
        if (intval($p->votos_porciento) > 0) {
            $grafica[] = "{name: '$p->nombre',y: $p->electos,color: '$color'}";
        }else{
            $grafica[] = "{name: '$p->nombre', y: $p->electos, color: '$color',dataLabels: {enabled: false}}";
        }
        $partidos[] = $a;
    }  else{
        $partidos2[] = $a;
    }    
    unset($a);       
}


/* Si no se han puesto datos en la gráfica, porque no haya escaños para repartir, hacemos la gráfica con los votos */
if (!isset($grafica)){
    foreach ($xml->resultados->partido as $p){
        $p->nombre = addslashes($p->nombre);
        
        if (strpos($p->nombre, 'PP') !== false) $a['color'] = '#2E64FE';
        else if (strpos($p->nombre, 'PSOE') !== false) $a['color'] = '#FA5858';
        else if (strpos($p->nombre, 'IU') !== false) $a['color'] = '#BEF781';
        else if ($p->nombre == 'UPyD') $a['color'] = '#F781F3';
        else if ($p->nombre == 'PODEMOS') $a['color'] = '#9A2EFE';
        
            if (isset($a['color'])) $color = $a['color'];
        else $color = '';
            //$grafica[] = "['$p->nombre',   $p->electos]";
        if (intval($p->votos_porciento) > 10) {
            $grafica[] = "{
                        name: '$p->nombre',
                        y: $p->votos_numero,
                        color: '$color'
                    }";
        }else if(intval($p->votos_porciento) > 1){
            $grafica[] = "{
                        name: '$p->nombre',
                        y: $p->votos_numero,
                        color: '$color',
                        dataLabels: {
                            enabled: true
                        }
                    }";
        } else{
            if (!isset($otros)) $otros = 0;
            $otros += $p->votos_numero;
        }
        unset($a);
    }
    
    if (isset($otros)){
         $grafica[] = "{
            name: 'Otros',
            y: $otros,
            color: '#D8D8D8'
        }";
    }
    
}

switch($xml->tipo_sitio){
    case 1:
        $sitio = 'Total España';
        break;
    case 2:
        $sitio = $xml->nombre_sitio;
        break;
    case 3:
        $sitio = 'Circunscripción de '.$xml->nombre_sitio;
    case 4:
        $sitio = 'Comarca de '.$xml->nombre_sitio;
        break;
    case 5:
        $sitio = 'Municipio de '.$xml->nombre_sitio;
        break;
}    
    

?>

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
      <script src="http://code.highcharts.com/highcharts.js"></script>
      <script src="http://code.highcharts.com/modules/exporting.js"></script>
      
      <script type="text/javascript">
$(function () {
    var chart = $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: {
                load: function() {
                    this.renderer.text('<a href="#">alonsoftware.es</a>', 10, 393, 173, 57).css({color: '#848484', fontSize: '10px'}).add();
                }
            },   
            height:300,
        },
        title: {
            text: '',
        },
        /*
        title: {
            text: 'Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?><br>',
            align: 'center',
            verticalAlign: 'middle',
            fontFamily: 'Lato',
            y: -160
        },
       /* subtitle: {
            text: '<?echo $xml->nombre_lugar  ;?>. <?echo $sitio;?>',
            align: 'center',
            verticalAlign: 'middle',
            fontFamily: 'Lato',
            y: 160,
            style: {
                fontSize: 16
            }
        },*/
        tooltip: {
            pointFormat: '<?echo $xml->nombre_disputado ;?>: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        //fontWeight: 'bold',
                        color: 'black',
                        fontSize: 12,
                    },
                     //format: '<b>{point.name}</b>: {point.y} - {point.percentage:.1f}%',
                     format: '<b>{point.name}</b>: {point.y}',
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Partidos',
            innerSize: '50%',
            data: [
                <? echo implode(',', $grafica);?>
            ]
        }],
        exporting: {
            enableImages: true
        },
        
    });
    $('#button1').click(function () {
        var chart = $('#container').highcharts();
        chart.exportChart({type: 'application/pdf',filename: 'my-pdf'}, {
            chart: {
                backgroundColor: '#000000',
            }
        });
    });  
    
})


            $(function () {
                $('#container').highcharts({
                    chart: {type: 'pie',margin: [0, 0, 0, 0],
                        events: {load: function() {
                            this.renderer.text('<a href="#" id="button1">Descargar como PDF</a>', 10, 393, 173, 57).css({color: '#848484', fontSize: '10px'}).add();
                            this.renderer.text('<a href="#" id="button2">Descargar como PNG</a>', 200, 393, 173, 57).css({color: '#848484', fontSize: '10px'}).attr({id: 'text1'}).add();
                            }},      
                    },
                    series: [{ innerSize: '50%',data: [<? echo implode(',', $grafica);?>]}],
                    tooltip: {pointFormat: '<?echo $xml->nombre_disputado ;?>: <b>{point.y}</b>'},
                    plotOptions: {pie: {size:'100%',
                            dataLabels: {enabled: true,distance: -50,style: {color: 'black',fontSize: 12,},format: '{point.name}: {point.y}',},
                            startAngle: -90,endAngle: 90,center: ['50%', '75%'],}},
                    title: {text: '',},
                    credits: {enabled: false},
                });
                
                $('#button1').click(function () { 
                    var chart = $('#container').highcharts();
                    chart.exportChart({type: 'application/pdf',filename: 'my-pdf'}, {                        
                        title: {text: 'Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?><br>'},
                        subtitle: { text: '<?echo $xml->nombre_lugar  ;?>. <?echo $sitio;?>',align: 'center',verticalAlign: 'middle',fontFamily: 'Lato',y: 160,style: {fontSize: 16}},
                    });
                });  
                
            });
      </script>
          
            
      </script>
  </head>
  <body>
      
    <header>
        <div class="row" style="margin-top:5px">
            <div class="medium-3 columns">
                  <img style="width:100%" src="img/logo.png">
            </div>
            <div class="medium-9 columns">
                <div class="icon-bar six-up" style="background-color:#fff">
                  <a class="item">
                    Home
                  </a>
                  <a class="item">
                    Home
                  </a>
                  <a class="item">
                    Home
                  </a>
                  <a class="item">
                    Home
                  </a>
                  <a class="item">
                    Home
                  </a>
                  <a class="item">
                    Home
                  </a>
                </div>
            </div>
        </div>
    </header>  
      
    <div class="row">
      <div class="medium-12 columns">
        <h1>Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?></h1>
         <table style="width:100%; text-align:center;">
             <tr>
                <td>Votos: <?echo number_format(intval($xml->votos->contabilizados->cantidad), 0, ',', '.');?> (<?echo $xml->votos->contabilizados->porcentaje;?> %)</td>
                <td>Blancos: <?echo number_format(intval($xml->votos->blancos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->blancos->porcentaje;?> %)</td>
                <td>Nulos: <?echo number_format(intval($xml->votos->nulos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->nulos->porcentaje;?> %)</td>
                <td>Abstenciones: <?echo number_format(intval($xml->votos->abstenciones->cantidad), 0, ',', '.');?> (<?echo $xml->votos->abstenciones->porcentaje;?> %)</td>
             </tr>
         </table> 
      </div>
    </div>
      
    <div class="row">
        <div class="medium-6 columns">
            <div id="container" style="with=100%"></div>
        </div>
        <div class="medium-6 columns">
            <?if (isset($partidos)){?>
            <h3>Partidos con representación</h3>
            <table style="width: 100%">
              <thead>
                  <tr>
                        <th style="width:50%">Partido</th>
                        <th style="width:25%; text-align:right;">Votos</th>
                        <th style="width:15%; text-align:right;">Porcentaje</th>
                        <th style="width:10%; text-align:right;">Escaños</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['electos']), 0, ',', '.');?></td>
                    </tr>
                    <?}?>
              </tbody>
            </table>
            <?}?>
            
            <?if (isset($partidos2)){?>
            <?if (isset($partidos)){?>
            <h3>Partidos sin representación</h3>
            <?}?>
            <table style="width: 100%">
              <thead>
                  <tr>
                        <th style="width:50%">Partido</th>
                        <th style="width:25%; text-align:right;">Votos</th>
                        <th style="width:15%; text-align:right;">Porcentaje</th>
                        <th style="width:10%; text-align:right;">Escaños</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos2 as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['electos']), 0, ',', '.');?></td>
                    </tr>
                    <?}?>
              </tbody>
            </table>
            <?}?>
      </div>
        <div class="large-12 columns">
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
