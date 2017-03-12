<?php

if (isset($_GET['provincia'])) $provincia = $_GET['provincia'];
else $provincia = 10;

if (isset($_GET['minimo'])) $minimo = $_GET['minimo'];
else $minimo = 3;

$xml=simplexml_load_file('http://resultados.elpais.com/elecciones/2011/autonomicas/10/'.$provincia.'.xml2') or die("Error: Cannot create object");

/*
$simple = file_get_contents('http://resultados.elpais.com/elecciones/2011/autonomicas/10/10.xml2');
$p = xml_parser_create();
xml_parse_into_struct($p, $simple, $vals, $index);
xml_parser_free($p);
echo $vals[9]['tag'];

echo '<br><br><br><br>';
print_r($vals);
*/
$num = $xml->num_a_elegir;
$votos = $xml->votos->contabilizados->cantidad;
$escanos_totales = 0;
$votos_temp = 0;

$j = 0;
foreach ($xml->resultados->partido as $p){
    
    
    $a['id'] = $j;
    $a['nombre'] = $p->nombre;
    $a['votos'] = $p->votos_numero;
    $a['por'] = $p->votos_porciento;
    $a['escanos_1'] = 0;
    $a['escanos_2'] = 0;
    $a['escanos_3'] = 0;
    $a['escanos_4'] = 0;
    $a['escanos_5'] = 0;
    $a['escanos_6'] = 0;
    if ($p->votos_porciento > $minimo){
        $j++; 
        $partidos[] = $a;                
    }else
        $partidos2[] = $a;    
    //echo ($p->votos_numero * 100 / ($votos - $xml->votos->nulos->cantidad) ).'<br>';
        
       
}


unset($temp);
// D'HONT
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
    $partidos[$temp[$i]['id']]['escanos_1'] += 1;
}

//


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
    $partidos[$temp[$i]['id']]['escanos_5'] += 1;
}

unset($temp);


// Sainte-Laguë Modificado
$temp = array();
foreach ($partidos as $p){
    for ($i = 0; $i < $num; $i++){
        if ($i == 1)
            $v['votos'] =  $p['votos'] / 1.4;
        else
            $v['votos'] =  $p['votos'] / 2*$i+1;            
        $v['nombre'] = $p['nombre'];
        $v['id'] = $p['id'];
        $temp[] = $v;
    }
}
rsort($temp);
for ($i = 0; $i < $num; $i++){
    $partidos[$temp[$i]['id']]['escanos_6'] += 1;
}


unset($temp);
//
// COEFICIENTE DROOP

$temp = array();

$q = round(1 + ($votos / ($num + 1)));
//echo 'Q: '.$q.'<br>';
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
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
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
//echo 'Q: '.$q.'<br>';
foreach ($partidos as $p){
    $p['escanos_3'] =  intval($p['votos'] / $q);   
    
    $v['votos'] =  $p['votos'] - $q * $p['escanos_2'];
    $v['nombre'] = $p['nombre'];
    $v['id'] = $p['id'];
    $temp[] = $v;
    //echo 'n: '.$p['votos'].'/'.$q.' = '.$p['escanos_2'].'<br>';    
    $partidos[$p['id']]['escanos_3'] = $p['escanos_3'];
    $escanos_totales += $p['escanos_3'];
}

rsort($temp);

$j = $num - $escanos_totales;
$p = 0;
for ($i = 0; $i < $j; $i++){
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
    if ($i >= count($temp)){
        $partidos[$temp[$p]['id']]['escanos_3'] += 1;
        $p++;
    }else
        $partidos[$temp[$i]['id']]['escanos_3'] += 1;
}

// IMPERIALI

unset($temp);
$escanos_totales = 0;

$q = round(($votos / ($num + 2)));
//echo 'Q: '.$q.'<br>';
foreach ($partidos as $p){
    $p['escanos_2'] =  intval($p['votos'] / $q);   
    
    $v['votos'] =  $p['votos'] - $q * $p['escanos_2'];
    $v['nombre'] = $p['nombre'];
    $v['id'] = $p['id'];
    $temp[] = $v;
    //echo 'n: '.$p['votos'].'/'.$q.' = '.$p['escanos_2'].'<br>';    
    $partidos[$p['id']]['escanos_4'] = $p['escanos_2'];
    $escanos_totales += $p['escanos_2'];
}

rsort($temp);

$j = $num - $escanos_totales;
$p = 0;
for ($i = 0; $i < $j; $i++){
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
    if ($i >= count($temp)){
        $partidos[$temp[$p]['id']]['escanos_4'] += 1;
        $p++;
    }else
        $partidos[$temp[$i]['id']]['escanos_4'] += 1;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, td, th {
            border: 1px solid black;
            text-align:center;
        }
        h1, h2 {
            text-align:center;
        }

        </style>
        <meta charset="UTF-8">
    </head>
    <body>
        <h1><?echo $xml->nombre_sitio ;?> <br><small><?echo $xml->nombre_lugar  ;?></small></h1>
        <h2>
            Escaños a repartir: <?echo $xml->num_a_elegir;?> - Mínimo de votos para tener representación: <? echo $minimo;?> %
        </h2>
        
        
        <h2>
            Votos totales: <? echo number_format(intval($xml->votos->contabilizados->cantidad), 0, ',', '.');?>
            <small> (<? echo $xml->votos->contabilizados->porcentaje ; ?> % de participación) </small>
        </h2>
        <h2>
            Votos en blanco: <? echo number_format(intval($xml->votos->blancos->cantidad), 0, ',', '.');?> - 
            Votos nulos: <? echo number_format(intval($xml->votos->nulos->cantidad), 0, ',', '.');?>
        </h2>
        <table>
            <tr>
                <th>Partido</th>
                <th>D'hont</th>
                <th>Coeficiente Hare</th>
                <th>Coeficiente Droop</th>
                <th>Imperiali</th>
                <th>Sainte-Laguë</th>
            </tr>
            <?foreach ($partidos as $p){ ?>
            <tr>
                <td><? echo $p['nombre']; ?><br>Votos: <? echo $p['votos']; ?></td>
                <td><? echo $p['escanos_1']; ?><br><small>(<? if ($p['escanos_1'] != 0) echo round($p['votos'] / $p['escanos_1'], 3); ?>)</small></td>
                <td><? echo $p['escanos_2']; ?><br><small>(<? if ($p['escanos_2'] != 0) echo round($p['votos'] / $p['escanos_2'], 3); ?>)</small></td>
                <td><? echo $p['escanos_3']; ?><br><small>(<? if ($p['escanos_3'] != 0) echo round($p['votos'] / $p['escanos_3'], 3); ?>)</small></td>
                <td><? echo $p['escanos_4']; ?><br><small>(<? if ($p['escanos_4'] != 0) echo round($p['votos'] / $p['escanos_4'], 3); ?>)</small></td>
                <td><? echo $p['escanos_5']; ?><br><small>(<? if ($p['escanos_5'] != 0) echo round($p['votos'] / $p['escanos_5'], 3); ?>)</small></td>
            </tr>
            <?}?>
        </table>
        
        <? if (isset($partidos2)){?>
        <h2>Partidos sin llegar al mínimo de votos (3% del total)</h2>
        
        <table>
            <tr>
                <th>Partido</th>
                <th>Votos</th>
                <th>Porcentajes</th>
                <th>Votos que le faltaron</th>
            </tr>
            <?foreach ($partidos2 as $p){ ?>
            <tr>
                <td><? echo $p['nombre']; ?></td>
                <td><? echo $p['votos']; ?></td>
                <td><? echo $p['por']; ?></td>
                <td><? echo round( ($minimo*($votos - $xml->votos->nulos->cantidad) / 100) - $p['votos'] ); ?></td>
            </tr>
            <?}?>
        </table>
        <?}?>
        
    </body>
</html>
