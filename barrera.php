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
        <h1>Barrera Electoral</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut condimentum nunc ac urna mollis, vitae condimentum augue bibendum. Cras pulvinar felis lectus, sit amet posuere lectus posuere id. Morbi purus justo, dictum eget augue et, molestie sollicitudin urna. Ut ac sem felis. Morbi viverra rutrum nulla iaculis feugiat. Praesent vitae augue et nisl placerat sollicitudin sit amet sed augue. Vivamus et dui ante. Proin eu est at justo commodo tristique. Sed ac metus a ipsum vulputate pellentesque. Proin in diam nibh. Ut lacinia elit commodo, scelerisque ex ac, accumsan lacus. Etiam quis luctus ligula. Curabitur eget sapien tempus, molestie mi a, posuere nisl.
            Donec eleifend quis diam nec hendrerit. Nullam tempor semper ornare. Proin libero leo, ornare non volutpat id, varius in magna. Suspendisse quis consequat ex. Nullam vitae egestas felis. Aliquam aliquet nulla turpis, et porta dui maximus id. Suspendisse eu mauris vitae metus maximus porttitor id eu felis. Nam rhoncus nulla sodales nulla fringilla convallis. Ut tempus elementum facilisis.
            </p>
          <hr>
          <h3 class="titulo_resultados" id="generales">Compara los resultados de las elecciones con otro tipo de sistema</h3>
            <form action="barrera_1.php" method="GET">
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
          
      </div>
    </div>
      
    <div class="row">
        <div class="large-1 columns">
            &nbsp;
        </div>
        <div class="large-10 columns">
            <div id="container" style="with=100%"></div>     
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
