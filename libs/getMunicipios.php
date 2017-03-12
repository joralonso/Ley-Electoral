<?php

echo file_get_contents('http://resultados.elpais.com/elecciones/2011/municipales/'.$_GET['comunidad'].'/'.$_GET['provincia'].'_include_Municipios_Options.html');
?>