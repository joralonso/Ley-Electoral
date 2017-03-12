<?php

require_once('./libs/funciones.php');

if (isset($_GET['sitio'])) {
    $sitio = $_GET['sitio'];
}else{
    header("HTTP/1.0 404 Not Found");
}

$tipo = 'generales';

if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
else{
    $year = 2011;
}


$xml=simplexml_load_file('http://resultados.elpais.com/elecciones/'.$year.'/'.$tipo.'/'.$sitio.'/index.xml2') or die("Error: Cannot create object");
foreach ($xml->resultados->partido as $p){
    
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['color'] = setColor($p->nombre);
    $color = $a['color'];
    
    if ($p->electos > 0){
        if (intval($p->electos) > 15) {
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
        
        $a['color'] = setColor($p->nombre);
        $color = $a['color'];
        
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
          
         /* $('#button1').click(function () { 
                    var chart = $('#container').highcharts();
                    chart.exportChart({type: 'application/pdf',filename: 'my-pdf'}, {                        
                        title: {text: 'Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?><br>'},
                        subtitle: { text: '<?echo $xml->nombre_lugar  ;?>. <?echo $sitio;?>',align: 'center',verticalAlign: 'middle',fontFamily: 'Lato',y: 160,style: {fontSize: 16}},
                    });
                });  */
          
          $(function () {
            var chart = $('#container').highcharts({
                chart: { plotBackgroundColor: null,plotBorderWidth: 0,plotShadow: false, height:300, },
                title: {text: '',align: 'center',verticalAlign: 'middle',y: -100},
                subtitle: {text: 'Total: <?echo intval($xml->num_a_elegir);?>. Mayoría Absoluta: <?echo intval($xml->num_a_elegir / 2 ) + 1;?>',align: 'center',verticalAlign: 'middle',y: 100},
                tooltip: {pointFormat: '<?echo $xml->nombre_disputado ;?>: <b>{point.y}</b>'},
                plotOptions: {
                    pie: {
                        dataLabels: { enabled: true, distance: -30, style: {color: 'black',fontSize: 12,},format: '<b>{point.name}</b>: {point.y}',},
                        startAngle: -90,endAngle: 90,center: ['50%', '75%']}
                },
                series: [{type: 'pie',name: 'Partidos',innerSize: '50%',data: [<? echo implode(',', $grafica);?>]}],
                exporting: { enabled: false },
                credits: { enabled: false},
            });    
        });
      </script>
  </head>
  <body>      
    <?php cabecera(); ?>       
    <div class="row">
      <div class="medium-12 columns">
          <h1>Elecciones Generales</h1>
          <h2>Resultados del <?echo $year;?> para el <?echo $xml->nombre_lugar;?></h2>
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
        <div class="large-2 columns">
            &nbsp;
        </div>
        <div class="large-8 columns">
            <div id="container" style="with=100%"></div>
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
        <div class="large-2 columns">
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
