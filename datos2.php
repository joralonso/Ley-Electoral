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

if ($xml->tipo_sitio == 5) $minimo = 5;

$j = 0;
$num = 0;
$num = $xml->num_a_elegir;
$votos = $xml->votos->contabilizados->cantidad;
$escanos_totales = 0;
$votos_temp = 0;


foreach ($xml->resultados->partido as $p){
    $a['id'] = $j;    
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['electos'] = $p->electos;    
    $a['color'] = setColor($p->nombre);
    $a['escanos_1'] = 0;
    $a['escanos_2'] = 0;
    $a['escanos_3'] = 0;
    $a['escanos_4'] = 0;
    $color = $a['color'];  
    if ($p->votos_porciento > $minimo){
        $j++; 
        $partidos[] = $a;                
    }else
        $partidos2[] = $a;    
    unset($a);       
}

/*
escanos_1 = D'hont
escanos_2 = Droop
escanos_3 = Hare
escanos_4 = Sainte
*/



/* CALCULAMOS LOS REPARTOS */

// D'HONT
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
for ($i = 0; $i < $num; $i++)
    $partidos[$temp[$i]['id']]['escanos_1'] += 1;


// Sainte-Laguë
unset($temp);
foreach ($partidos as $p){
    for ($i = 0; $i < $num; $i++){
        $v['votos'] =  $p['votos'] / 2*$i+1;
        $v['nombre'] = $p['nombre'];
        $v['id'] = $p['id'];
        $temp[] = $v;
    }
}
rsort($temp);
for ($i = 0; $i < $num; $i++){
    $partidos[$temp[$i]['id']]['escanos_4'] += 1;
}


// COEFICIENTE DROOP
unset($temp);
$q = round(1 + ($votos / ($num + 1)));
foreach ($partidos as $p){
    $p['escanos_2'] =  intval($p['votos'] / $q);   
    
    $v['votos'] =  $p['votos'] - $q * $p['escanos_2'];
    $v['nombre'] = $p['nombre'];
    $v['id'] = $p['id'];
    $temp[] = $v;
    //echo 'n: '.$p['votos'].'/'.$q.' = '.$p['escanos_2'].'<br>';    
    $partidos[$p['id']]['escanos_2'] = $p['escanos_2'];
    $escanos_totales += $p['escanos_2'];
}
rsort($temp);
$j = $num - $escanos_totales;
$p = 0;
for ($i = 0; $i < $j; $i++){
    if ($i >= count($temp)){
        $partidos[$temp[$p]['id']]['escanos_2'] += 1;
        $p++;
    }else
        $partidos[$temp[$i]['id']]['escanos_2'] += 1;
}


// COCIENTE HARE


unset($temp);
$escanos_totales = 0;
$q = round(($votos / ($num)));
foreach ($partidos as $p){
    $p['escanos_3'] =  intval($p['votos'] / $q);   
    
    $v['votos'] =  $p['votos'] - $q * $p['escanos_3'];
    $v['nombre'] = $p['nombre'];
    $v['id'] = $p['id'];
    $temp[] = $v;   
    $partidos[$p['id']]['escanos_3'] = $p['escanos_3'];
    $escanos_totales += $p['escanos_3'];
}
rsort($temp);
$j = $num - $escanos_totales;
$p = 0;
for ($i = 0; $i < $j; $i++){
    if ($i >= count($temp)){
        $partidos[$temp[$p]['id']]['escanos_3'] += 1;
        $p++;
    }else
        $partidos[$temp[$i]['id']]['escanos_3'] += 1;
}

foreach ($partidos as $p)
    $grafica[] = "{name: '".$p['nombre']."',data: [".$p['escanos_1'].", ".$p['escanos_2'].", ".$p['escanos_3'].", ".$p['escanos_4']."], color: '".$p['color']."'}";


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
        chart: {type: 'column'},
        xAxis: {categories: ["D'hont", 'Hare', 'Droop', 'Sainte-Laguë']},
        yAxis: {min: 0, title: {text: '<?echo $xml->nombre_disputado ;?> conseguidos'},
                stackLabels: {enabled: true, style: {fontWeight: 'bold',color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'}}},
        tooltip: {
            formatter: function () {return '<b>' + this.x + '</b><br/>' +this.series.name + ': ' + this.y + '<br/>' +'Total: ' + this.point.stackTotal;}},
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                },
                borderWidth: 0
            }
        },
        series: [<?echo implode(',', $grafica);?>]
    });
});
          
$(function () {
    $('#container').highcharts({
        chart: {type: 'bar'},
        title: {text: ''},
        xAxis: {categories: ["D'hont", 'Hare', 'Droop', 'Sainte-Laguë']},
        yAxis: { min: 0,title: {text: '<?echo $xml->nombre_disputado ;?> conseguidos'}},
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
          <h1>Comparativa de los distintos sistemas de reparto de escaños</h1>
         <h1>Resultados de las elecciones <?echo $tipo;?> del <?echo $year;?></h1>
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
                        <th style="width:10%; text-align:right;">D'hont</th>
                        <th style="width:10%; text-align:right;">Hare</th>
                        <th style="width:10%; text-align:right;">Droop</th>
                        <th style="width:10%; text-align:right;">Sainte-Laguë</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['electos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_2']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_3']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['escanos_4']), 0, ',', '.');?></td>
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
                        <th style="width:10%; text-align:right;">Votos necesarios</th>
                  </tr>
              </thead>
              
              <tbody>
                    <?foreach ($partidos2 as $p){?>
                    <tr>
                        <td><?echo $p['nombre'];?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['votos']), 0, ',', '.');?></td>
                        <td style="text-align:right"><?echo number_format(intval($p['por']), 2, ',', '.');?></td>
                        <td style="text-align:right"><? echo number_format( ($minimo*($votos - $xml->votos->nulos->cantidad) / 100) - $p['votos'], 0, ',', '.'); ?></td>
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
