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

$j = 0;
$xml=simplexml_load_file('http://resultados.elpais.com/elecciones/'.$year.'/'.$tipo.'/'.$sitio.'/index.xml2') or die("Error: Cannot create object");
foreach ($xml->resultados->partido as $p){
    $a['id'] = $j;
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['escanos_1'] = 0;        
    $a['escanos_2'] = 0;        
    $a['escanos_3'] = 0;    
    $a['color'] = setColor($p->nombre);
    $color = $a['color'];
    
    $partidos[] = $a;
    unset($a);  
    $j++;
}

$num = $xml->num_a_elegir;
$votos = $xml->votos->contabilizados->cantidad;
$escanos_totales = 0;
$votos_temp = 0;



// D'HONT MINIMO 5
unset($temp);
foreach ($partidos as $p){
    if ($p['por'] > 5)
        for ($i = 1; $i < $num; $i++){
            $v['votos'] =  $p['votos'] / $i;
            $v['nombre'] = $p['nombre'];
            $v['id'] = $p['id'];
            $temp[] = $v;
        }
}
rsort($temp);
for ($i = 0; $i < $num; $i++){
    $partidos[$temp[$i]['id']]['escanos_1'] += 1;
}


// D'HONT MINIMO 3
unset($temp);
foreach ($partidos as $p){
    if ($p['por'] > 3)
        for ($i = 1; $i < $num; $i++){
            $v['votos'] =  $p['votos'] / $i;
            $v['nombre'] = $p['nombre'];
            $v['id'] = $p['id'];
            $temp[] = $v;
        }
}
rsort($temp);
for ($i = 0; $i < $num; $i++){
    $partidos[$temp[$i]['id']]['escanos_2'] += 1;
}

// D'HONT MINIMO 0
unset($temp);
foreach ($partidos as $p){
        for ($i = 1; $i < $num; $i++){
            $v['votos'] =  $p['votos'] / $i;
            $v['nombre'] = $p['nombre'];
            $v['id'] = $p['id'];
            $temp[] = $v;
        }
}
rsort($temp);
for ($i = 0; $i < $num; $i++){
    $partidos[$temp[$i]['id']]['escanos_3'] += 1;
}
   


foreach ($partidos as $p){
    if ($p['electos'] > 0 || $p['escanos_1'] > 0 || $p['escanos_2'] > 0 || $p['escanos_3'] > 0 ){
        $grafica[] = "{name: '".$p['nombre']."',data: [".$p['electos'].",".$p['escanos_1'].", ".$p['escanos_2'].", ".$p['escanos_3']."], color: '".$p['color']."'}";
        $partidos_1[] = $p;
    }else{
        $partidos_2[] = $p;
    }
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
    $('#container').highcharts({
        chart: {type: 'bar'},
        title: {text: ''},
        xAxis: {categories: ["Provincial", 'Nacional<br>(Mínimo 5%)', 'Nacional<br>(Mínimo 3%)', 'Nacional<br>(Sin Mínimo)']},
        yAxis: { min: 0,title: {text: '<?echo $xml->nombre_disputado ;?> conseguidos'}, max: <?echo intval($xml->num_a_elegir);?>},
        legend: { reversed: true},
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: [<?echo implode(',', $grafica);?>]
    });
});
      </script>
  </head>
  <body>      
    <?php cabecera(); ?>       
    <div class="row">
      <div class="medium-12 columns">
          <h1>Circunscripciones</h1>
          <h2>Comparativa de resultados con distintas circunscripciones</h2>
          <h2>Resultados del <?echo $year;?> para el <?echo $xml->nombre_lugar;?></h2>
          <table style="width:100%; text-align:center;">
             <tr>
                <td>Votos: <?echo number_format(intval($xml->votos->contabilizados->cantidad), 0, ',', '.');?> (<?echo $xml->votos->contabilizados->porcentaje;?> %)</td>
                <td>Blancos: <?echo number_format(intval($xml->votos->blancos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->blancos->porcentaje;?> %)</td>
                <td>Nulos: <?echo number_format(intval($xml->votos->nulos->cantidad), 0, ',', '.');?> (<?echo $xml->votos->nulos->porcentaje;?> %)</td>
                <td>Abstenciones: <?echo number_format(intval($xml->votos->abstenciones->cantidad), 0, ',', '.');?> (<?echo $xml->votos->abstenciones->porcentaje;?> %)</td>
             </tr>
         </table> 
          
          
          <div id="container" style="with=100%"></div>
      </div>
    </div>
      
    <div class="row">
        <div class="large-2 columns">
            &nbsp;
        </div>
        <div class="large-8 columns">
            
            <?if (isset($partidos_1)){?>
            <h3>Partidos con representación</h3>
            <table style="width: 100%">
              <thead>
                  <tr>
                        <th style="width:50%">Partido</th>
                        <th style="width:25%; text-align:right;">Votos</th>
                        <th style="width:15%; text-align:right;">Porcentaje</th>
                        <th style="width:10%; text-align:right;">Provincial</th>
                        <th style="width:10%; text-align:right;">Nacional (Mínimo 5%)</th>
                        <th style="width:10%; text-align:right;">Nacional (Mínimo 3%)</th>
                        <th style="width:10%; text-align:right;">Nacional (Sin Mínimo)</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos_1 as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['electos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_1']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_2']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_3']), 0, ',', '.');?></td>
                    </tr>
                    <?}?>
              </tbody>
            </table>
            <?}?>
            
            <?if (isset($partidos_2)){?>
            <?if (isset($partidos_1)){?>
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
                    <?foreach ($partidos_2 as $p){?>
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
