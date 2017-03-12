<?php

require_once('./libs/funciones.php');

if (isset($_GET['provincia'])) {
    $provincia = $_GET['provincia'];
}else{
    header("HTTP/1.0 404 Not Found");
}

if (isset($_GET['comunidad'])) {
    $comunidad = $_GET['comunidad'];
}else{
    header("HTTP/1.0 404 Not Found");
}

if (isset($_GET['municipio'])) {
    $municipio = explode('/', $_GET['municipio'])[1];
}else{
    header("HTTP/1.0 404 Not Found");
}

$tipo = 'municipales';

if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
else{
    $year = 2011;
}


$xml=simplexml_load_file('http://resultados.elpais.com/elecciones/'.$year.'/'.$tipo.'/'.$comunidad.'/'.$provincia.'/'.$municipio.'.xml2') or die("Error: Cannot create object");
$j = 0;
$num = 0;
$num = $xml->num_a_elegir;
$votos = $xml->votos->contabilizados->cantidad;
$escanos_totales = 0;
$votos_temp = 0;

foreach ($xml->resultados->partido as $p){
    
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['color'] = setColor($p->nombre);
    $color = $a['color'];
    if ($p->votos_porciento > 5){
        $a['minimo1'] = true;
    }else{
        $a['minimo1'] = false;
    }
    
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


// CALCULAMOS DHONDT 2
$j = 0;
foreach ($xml->resultados->partido as $p){
    $a['id'] = $j;
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['color'] = setColor($p->nombre);
    $a['escanos_1'] = 0;
    $color = $a['color'];
    
    $a['por1'] = ($p->votos_numero * 100 / ($votos - $xml->votos->nulos->cantidad));
    $a['por2'] = ($p->votos_numero * 100 / ($votos - $xml->votos->nulos->cantidad- $xml->votos->blancos->cantidad));
                  
    //$a['por1'] = ($p->votos_numero * 100) / ($xml->votos->contabilizados->cantidad - $xml->votos->contabilizados->nulos);
    //$a['por2'] = ($p->votos_numero * 100) / ($xml->votos->contabilizados->cantidad - $xml->votos->contabilizados->blancos - $xml->votos->contabilizados->nulos);
    
    if ($a['por2'] > 5){
        $a['minimo2'] = true;
        $partidos3[] = $a;        
    }else{
        $a['minimo2'] = false;
        $partidos4[] = $a;
    }
    
    if ($p->votos_porciento > 5){
        $a['minimo1'] = true;
    }else{
        $a['minimo1'] = false;
    }
    
    $j++;
}

unset($temp);
foreach ($partidos3 as $p){
    for ($i = 1; $i < $num; $i++){
        $v['votos'] =  $p['votos'] / $i;
        $v['nombre'] = $p['nombre'];
        $v['id'] = $p['id'];
        $temp[] = $v;
    }
}
rsort($temp);
for ($i = 0; $i < $num; $i++)
    $partidos3[$temp[$i]['id']]['escanos_1'] += 1;

foreach ($partidos3 as $p){
    if ($p['escanos_1'] != 0)
         $grafica2[] = "{name: '".$p['nombre']."',y: ".$p['escanos_1'].",color: '".$p['color']."'}";
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
                chart: { plotBackgroundColor: null,plotBorderWidth: 0,plotShadow: false, height:300, },
                title: {text: 'Con votos en blanco',align: 'center',verticalAlign: 'middle',y: -100},
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
          
          $(function () {
            var chart = $('#container2').highcharts({
                chart: { plotBackgroundColor: null,plotBorderWidth: 0,plotShadow: false, height:300, },
                title: {text: 'Sin votos en blanco',align: 'center',verticalAlign: 'middle',y: -100},
                subtitle: {text: 'Total: <?echo intval($xml->num_a_elegir);?>. Mayoría Absoluta: <?echo intval($xml->num_a_elegir / 2 ) + 1;?>',align: 'center',verticalAlign: 'middle',y: 100},
                tooltip: {pointFormat: '<?echo $xml->nombre_disputado ;?>: <b>{point.y}</b>'},
                plotOptions: {
                    pie: {
                        dataLabels: { enabled: true, distance: -30, style: {color: 'black',fontSize: 12,},format: '<b>{point.name}</b>: {point.y}',},
                        startAngle: -90,endAngle: 90,center: ['50%', '75%']}
                },
                series: [{type: 'pie',name: 'Partidos',innerSize: '50%',data: [<? echo implode(',', $grafica2);?>]}],
                exporting: {enableImages: true},
                exporting: { enabled: false },
                credits: { enabled: false},
            });    
        });
      </script>
          
            
      </script>
  </head>
  <body>      
    <?php cabecera(); ?>       
    <div class="row">
      <div class="medium-12 columns">
        <h1>Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?></h1>
          <h2><?echo $xml->nombre_lugar;?> de <?echo $xml->nombre_sitio;?></h2>
         <table style="width:100%; text-align:center;">
             <tr>
                <td style="text-align:center;">Votos: <?echo number_format(intval($xml->votos->contabilizados->cantidad), 0, ',', '.');?> (<?echo $xml->votos->contabilizados->porcentaje;?> %)</td>
                <td style="text-align:center;">Blancos: <?echo number_format(intval($xml->votos->blancos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->blancos->porcentaje;?> %)</td>
                <td style="text-align:center;">Nulos: <?echo number_format(intval($xml->votos->nulos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->nulos->porcentaje;?> %)</td>
                <td style="text-align:center;">Abstenciones: <?echo number_format(intval($xml->votos->abstenciones->cantidad), 0, ',', '.');?> (<?echo $xml->votos->abstenciones->porcentaje;?> %)</td>
             </tr>
         </table> 
      </div>
    </div>
      
   <div class="row">
       <div class="medium-6 columns">
           <div id="container" style="with=100%"></div>
       </div>
       <div class="medium-6 columns">
           <div id="container2" style="with=100%"></div>
       </div>
    </div>
      
    <div class="row">
        <div class="large-1 columns">
            &nbsp;
        </div>
        <div class="large-10 columns">
            <div id="container" style="with=100%"></div>
            <?if (isset($partidos3)){?>
            <h3>Partidos con representación</h3>
            <table style="width: 100%">
              <thead>
                  <tr>
                        <th style="width:35%">Partido</th>
                        <th style="width:15%; text-align:right;">Votos</th>
                        <th style="width:10%; text-align:right;">Porcentaje</th>
                        <th style="width:10%; text-align:right;">Porcentaje (Sin votos en blanco)</th>
                        <th style="width:15%; text-align:right;">Escaños</th>
                        <th style="width:15%; text-align:right;">Escaños (Sin votos en blanco)</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos3 as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(floatval($p['por']), 2, ',', '.');?> %</td>
                        <td style="text-align:right"><?echo number_format(floatval($p['por2']), 2, ',', '.');?> %</td>
                        <?if ($p['por'] < 5){?>
                        <td style="text-align:right">-</td>
                        <?}else{?>
                        <td style="text-align:right"><?echo number_format(intval($p['electos']), 0, ',', '.');?></td>
                        <?}?>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_1']), 0, ',', '.');?></td>
                    </tr>
                    <?}?>
              </tbody>
            </table>
            <?}?>
            
            <?if (isset($partidos4)){?>
            <?if (isset($partidos3)){?>
            <h3>Partidos sin representación</h3>
            <?}?>
            <table style="width: 100%">
              <thead>
                  <tr>
                        <th style="width:35%">Partido</th>
                        <th style="width:15%; text-align:right;">Votos</th>
                        <th style="width:10%; text-align:right;">Porcentaje</th>
                        <th style="width:10%; text-align:right;">Porcentaje (Sin votos en blanco)</th>
                        <th style="width:15%; text-align:right;">Escaños</th>
                        <th style="width:15%; text-align:right;">Escaños (Sin votos en blanco)</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos4 as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por2']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(floatval($p['electos']), 0, ',', '.');?> %</td>
                        <td style="text-align:right"><?echo number_format(floatval($p['escanos_1']), 0, ',', '.');?> %</td>
                    </tr>
                    <?}?>
              </tbody>
            </table>
            <?}?>
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
