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

      
    </head>
  <body>
    <?php cabecera(); ?>      
    <div class="row">
      <div class="medium-12 columns">
        <h1>Resultados de las Elecciones</h1>
         
      </div>
    </div>
      
    <div class="row">
        <div class="large-1 columns">
            &nbsp;
        </div>
        <div class="large-10 columns">           
            <h3 class="titulo_resultados" id="municipales">Elecciones Municipales</h3>
            <form action="municipales.php" method="GET">
                <div class="row">
                    <div class="large-3 columns">
                        <label>Año
                        <select name="year">
                            <option value="2011">2011</option>
                            <option value="2007">2007</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Comunidad
                        <select onchange="$('#municipio').html(''); $('#provincia').html(''); idCA=this.options[this.selectedIndex].value; if (this.options[this.selectedIndex].value.length>0) $('#provincia').load('./libs/getProvincias.php?comunidad=' + this.options[this.selectedIndex].value);" class="form-tipo2 comunidad2" id="comunidad" name="comunidad">
                            <option value="">Seleccione una</option><option value="01">Andalucía</option><option value="02">Aragón</option><option value="03">Asturias</option><option value="04">Baleares</option><option value="05">Canarias</option><option value="06">Cantabria</option><option value="07">Castilla La Mancha</option><option value="08">Castilla y León</option><option value="09">Cataluña</option><option value="18">Ceuta</option><option value="17">C. Valenciana</option><option value="10">Extremadura</option><option value="11">Galicia</option><option value="16">La Rioja</option><option value="12">Madrid</option><option value="19">Melilla</option><option value="15">Murcia</option><option value="13">Navarra</option><option value="14">País Vasco</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Provincia
                        <select onchange="$('#municipio').html(''); idProv=this.options[this.selectedIndex].value; if (this.options[this.selectedIndex].value.length>0) $('#municipio').load('./libs/getMunicipios.php?comunidad=' + idCA + '&provincia=' + this.options[this.selectedIndex].value )" name="provincia" id="provincia" class="form-tipo2">
                        </select>
                        </label>
                    </div>
                    <div class="large-3 columns">
                        <label>Municipio
                        <select onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" name="municipio" id="municipio" class="form-tipo2">
                        </select>
                        </label>
                    </div>
                </div>            
            </form>            
            
            <hr>
            
            <h3 class="titulo_resultados" id="autonomicas">Elecciones Autonómicas</h3>
            <form action="autonomicas.php" method="GET">
                <div class="row">
                    <div class="large-6 columns">
                        <label>Año
                        <select name="year">
                            <option value="2011">2011</option>
                            <option value="2007">2007</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-6 columns">
                        <label>Comunidad
                        <select onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" class="form-tipo2 comunidad2" id="comunidad" name="comunidad">
                            <option value="">Seleccione una</option><option value="01">Andalucía</option><option value="02">Aragón</option><option value="03">Asturias</option><option value="04">Baleares</option><option value="05">Canarias</option><option value="06">Cantabria</option><option value="07">Castilla La Mancha</option><option value="08">Castilla y León</option><option value="09">Cataluña</option><option value="18">Ceuta</option><option value="17">C. Valenciana</option><option value="10">Extremadura</option><option value="11">Galicia</option><option value="16">La Rioja</option><option value="12">Madrid</option><option value="19">Melilla</option><option value="15">Murcia</option><option value="13">Navarra</option><option value="14">País Vasco</option>
                        </select>
                        </label>
                    </div>
                </div>            
            </form>      
            
            <hr>
            
            <h3 class="titulo_resultados" id="generales">Elecciones Generales</h3>
            <form action="generales.php" method="GET">
                <div class="row">
                    <div class="large-6 columns">
                        <label>Año
                        <select name="year">
                            <option value="2011">2011</option>
                            <option value="2008">2008</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-6 columns">
                        <label>Año
                        <select onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" name="sitio">
                            <option value="">Seleccione una</option>
                            <option value="congreso">Congreso</option>
                            <option value="senado">Senado</option>
                        </select>
                        </label>
                    </div>
                </div>            
            </form>
            
            <hr>
            
             <h3 class="titulo_resultados" id="europeas">Elecciones Europeas</h3>
            <form action="europeas.php" method="GET">
                <div class="row">
                    <div class="large-6 columns">
                        <label>Año
                        <select name="year">
                            <option value="2014">2014</option>
                            <option value="2007">2007</option>
                        </select>
                        </label>
                    </div>
                    <div class="large-6 columns">
                        <label>Año
                        <select id="pais" onchange="if (this.options[this.selectedIndex].value.length>0) this.form.submit()" >
                            <option selected="selected">Selecciona país</option>
                            <option value="23">Alemania</option>
                            <option value="09">Austria</option>
                            <option value="30">Bélgica</option>
                            <option value="26">Bulgaria</option>
                            <option value="16">Chipre</option>
                            <option value="24">Dinamarca</option>
                            <option value="04">Eslovaquia</option>
                            <option value="05">Eslovenia</option>
                            <option value="19">España</option>
                            <option value="22">Estonia</option>
                            <option value="03">Finlandia</option>
                            <option value="18">Francia</option>
                            <option value="20">Grecia</option>
                            <option value="12">Hungría</option>
                            <option value="17">Italia</option>
                            <option value="21">Irlanda</option>
                            <option value="15">Letonia</option>
                            <option value="14">Lituania</option>
                            <option value="13">Luxemburgo</option>
                            <option value="11">Malta</option>
                            <option value="10">Países Bajos</option>
                            <option value="0">Polonia</option>
                            <option value="07">Portugal</option>
                            <option value="25">República Checa</option>
                            <option disabled="" value="31">Reino Unido</option>
                            <option value="06">Rumanía</option>
                            <option value="02">Suecia</option>
                        </select>
                        </label>
                    </div>
                </div>            
            </form>
            
      </div>
        <div class="large-1 columns">
           &nbsp; 
        </div>
    </div>
    
      
      <script language="JavaScript" type="text/JavaScript">
        $(document).ready(function(){
            $("#comunidad").on('change',function(event){

            var id = $("#regiones").find(':selected').val();

           $("#provincias").load('provincias.php?id='+id);
       });
       $("#provincias").on('change',function(event){
          var id = $("#provincias").find(':selected').val();
          $("#comunas").load('comunas.php?id='+id);
          });
      });
          
          </script>
      
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
