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
        <h1>La Ley Electoral</h1>
          <p>En esta página intentaremos explicarte, con ejemplos reales y comparativas, los cuatro aspectos que más preocupan de la ley electoral:</p>

          <div class="row">
              <div class="medium-3 columns">
                  <a href="sistemadhondt.php">
                     <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/congreso1.png">
                  </a>
              </div>
              <div class="medium-9 columns">
                  <h4 style="text-align:left"><a href="sistemadhondt.php">Sistema D'hondt</a></h4>
                  <p>¿Es justo el sistema D'hont? ¿Ayuda a la mayoría? ¿Perjudica a la minoría? ¿Qué alternativas hay?</p>
              </div>
              
          </div>
          <div class="row">
              
              <div class="medium-3 columns">
                  <a href="sistemadhondt.php">
                     <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/sobre1.png">
                  </a>
              </div>
              <div class="medium-9 columns">
                  <h4 style="text-align:left"><a href="blanco.php">Votos en blanco</a></h4>
                  <p>¿Van para la mayoría? ¿Son lo mismo que el voto nulo? ¿Como afectan?</p>
              </div>
              
          </div>
          <div class="row">
              
              
              <div class="medium-3 columns">
                  <a href="sistemadhondt.php">
                     <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/mapa1.png">
                  </a>
              </div>
              <div class="medium-9 columns">
                  <h4 style="text-align:left"><a href="circunscripcion.php">Circunscripcion</a></h4>
                  <p>¿Qué tipo de circunscripción se usa? ¿Es más justa la provincial o la nacional?</p>
              </div>
              
          </div>
          <div class="row">
              
              
              <div class="medium-3 columns">
                  <a href="sistemadhondt.php">
                     <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/porciento1.png">
                  </a>
              </div>
              <div class="medium-9 columns">
                  <h4 style="text-align:left"><a href="barrera.php">Barrera Electoral</a></h4>
                  <p>¿Qué es esto? ¿Perjudica a los partidos mayoritarios o minoritarios?</p>
              </div>
          </div>
              
          </div>
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
