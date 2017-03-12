<?php


function setColor($nombre_partido){
    
    if (strpos($nombre_partido, 'PP') !== false) return '#2E64FE';
    else if (strpos($nombre_partido, 'PSOE') !== false) return '#FA5858';
    else if (strpos($nombre_partido, 'IU') !== false) return '#BEF781';
    else if ($nombre_partido == 'UPyD') return '#F781F3';
    else if ($nombre_partido== 'PODEMOS') return '#9A2EFE';
        
        
    else return '';    
}


function provincias(){?>
<select name="provincia">
    <option value="11-15">A Coruña</option>
    <option value="14-01">Álava</option>
    <option value="07-02">Albacete</option>
    <option value="17-03">Alicante / Alacant</option>
    <option value="01-04">Almería</option>
    <option value="03">Asturias</option>
    <option value="08-05">Ávila</option>
    <option value="10-06">Badajoz</option>
    <option value="09-08">Barcelona</option>
    <option value="14-48">Bizkaia</option>
    <option value="08-09">Burgos</option>
    <option value="10-10">Cáceres</option>
    <option value="01-11">Cádiz</option>
    <option value="06">Cantabria</option>
    <option value="17-12">Castellón / Castelló</option>
    <option value="18-">Ceuta</option>
    <option value="07-13">Ciudad Real</option>
    <option value="01-14">Córdoba</option>
    <option value="07-16">Cuenca</option>
    <option value="09-17">Girona</option>
    <option value="01-18">Granada</option>
    <option value="07-19">Guadalajara</option>
    <option value="14-20">Gipuzkoa</option>
    <option value="01-21">Huelva</option>
    <option value="02-22">Huesca</option>
    <option value="04-07">Illes Balears</option>
    <option value="01-23">Jaén</option>
    <option value="08-24">León</option>
    <option value="09-25">Lleida</option>
    <option value="16">La Rioja</option>
    <option value="11-27">Lugo</option>
    <option value="12">Madrid</option>
    <option value="01-29">Málaga</option>
    <option value="19">Melilla</option>
    <option value="15">Murcia</option>
    <option value="13">Navarra</option>
    <option value="11-32">Ourense</option>
    <option value="08-34">Palencia</option>
    <option value="05-35">Las Palmas</option>
    <option value="11-36">Pontevedra</option>
    <option value="08-37">Salamanca</option>
    <option value="05-38">Santa Cruz de Tenerife</option>
    <option value="08-40">Segovia</option>
    <option value="01-41">Sevilla</option>
    <option value="08-42">Soria</option>
    <option value="09-43">Tarragona</option>
    <option value="02-44">Teruel</option>
    <option value="07-45">Toledo</option>
    <option value="17-46">Valencia / València</option>
    <option value="08-47">Valladolid</option>
    <option value="08-49">Zamora</option>
    <option value="02-50">Zaragoza</option>
</select>

<? }


function cabecera(){?>

    <header>
        <div class="row" style="margin-top:5px">
            <div class="medium-4 columns">
                <a href="index.php">
                  <img style="width:80%" src="img/logo.png">
                </a>
            </div>
            <div class="medium-8 columns">
                <div class="icon-bar four-up" style="background-color:#fff">
                  <a class="item" href="index.php">
                    Home
                  </a>
                  <a class="item" href="resultados.php">
                    Resultados
                  </a>
                  <a class="item" href="leyelectoral.php">
                    Ley Electoral
                  </a>
                  <a class="item" href="about.php">
                    About
                  </a>
                </div>
            </div>
        </div>
    </header>  

<?}

?>