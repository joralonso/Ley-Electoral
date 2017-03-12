<?php
$num = 21;
$votos = 0;
$escanos_totales = 0;

$a['id'] = 0;
$a['nombre'] = 'Partido A';
$a['votos'] = 391000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

$a['id'] = 1;
$a['nombre'] = 'Partido B';
$a['votos'] = 311000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

$a['id'] = 2;
$a['nombre'] = 'Partido C';
$a['votos'] = 184000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

$a['id'] = 3;
$a['nombre'] = 'Partido D';
$a['votos'] = 73000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

$a['id'] = 4;
$a['nombre'] = 'Partido E';
$a['votos'] = 27000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

$a['id'] = 5;
$a['nombre'] = 'Partido F';
$a['votos'] = 12000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;


$a['id'] = 6;
$a['nombre'] = 'Partido G';
$a['votos'] = 2000;
$a['escanos_1'] = 0;
$a['escanos_2'] = 0;
$a['escanos_3'] = 0;
$a['escanos_4'] = 0;
$partidos[] = $a;

foreach ($partidos as $p){
    $votos += $p['votos'];
}

echo 'VOTOS: '.$votos.'<br>';

$v;

// D'HONT
foreach ($partidos as $p){
    $votos += $v['votos'];
    //echo $p['nombre'].'<br>';
    for ($i = 1; $i < 200; $i++){
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

for ($i = 0; $i < $j; $i++){
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
    $partidos[$temp[$i]['id']]['escanos_2'] += 1;
}

// COCIENTE HARE


$temp = array();
$escanos_totales = 0;

$q = round(($votos / ($num)));
//echo 'Q: '.$q.'<br>';
foreach ($partidos as $p){
    $p['escanos_2'] =  intval($p['votos'] / $q);   
    
    $v['votos'] =  $p['votos'] - $q * $p['escanos_2'];
    $v['nombre'] = $p['nombre'];
    $v['id'] = $p['id'];
    $temp[] = $v;
    //echo 'n: '.$p['votos'].'/'.$q.' = '.$p['escanos_2'].'<br>';    
    $partidos[$p['id']]['escanos_3'] = $p['escanos_2'];
    $escanos_totales += $p['escanos_2'];
}

rsort($temp);

$j = $num - $escanos_totales;

for ($i = 0; $i < $j; $i++){
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
    $partidos[$temp[$i]['id']]['escanos_3'] += 1;
}

// IMPERIALI

$temp = array();
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

for ($i = 0; $i < $j; $i++){
    //echo $temp[$i]['id'].' '.$temp[$i]['resto'].'<br>';
    $partidos[$temp[$i]['id']]['escanos_4'] += 1;
}



echo '<table>';
echo '<tr>
    <th>Partido</th>
    <th>Votos</th> 
    <th>Ley D\'hont</th>
    <th>Coeficiente Hare</th>
    <th>Coeficiente Droop</th>
    <th>Imperiali</th>
  </tr>';
foreach ($partidos as $p){
    
    echo '<tr>';
    echo '<td>'.$p['nombre'].'</td>';
    echo '<td>'.$p['votos'].'</td>';
    echo '<td>'.$p['escanos_1'].'</td>';
    echo '<td>'.$p['escanos_2'].'</td>';
    echo '<td>'.$p['escanos_3'].'</td>';
    echo '<td>'.$p['escanos_4'].'</td>';
    echo '</tr>';
}
echo '</table>';

?>