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
  </head>
  <body>
      
    
    <?php cabecera();?>  
    <div class="row">
      <div class="medium-12 columns">
        <h1>Resultados Electorales</h1>
      </div>
    </div>
      
    <div class="row">
      <div class="medium-3 columns">
         <h3 style="text-align:center"><a href="resultados.php#municipales">Municipales</a></h3> 
      </div>
      <div class="medium-3 columns">
         <h3 style="text-align:center"><a href="resultados.php#autonomicas">Autonómicas</a></h3> 
      </div>
      <div class="medium-3 columns">
         <h3 style="text-align:center"><a href="resultados.php#generales">Generales</a></h3> 
      </div>
      <div class="medium-3 columns">
         <h3 style="text-align:center"><a href="resultados.php#europeas">Europeas</a></h3> 
      </div>
    </div>
    
    <div class="row">
      <div class="medium-12 columns">
        <h1>Información sobre la ley electoral</h1>
      </div>
    </div>
    
    <div class="row">
      <div class="medium-3 columns">
            <a href="sistemadhondt.php">
              <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/congreso1.png">
              <h3 style="text-align:center">Sistema D'hont</h3> 
            </a>
          <p style="font-family:Merriweather; font-size:11pt;">¿Es justo el sistema D'hont? ¿Ayuda a la mayoría? ¿Perjudica a la minoría? ¿Qué alternativas hay?</p>
      </div>
      <div class="medium-3 columns">
           <a href="blanco.php">
             <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/sobre1.png">
             <h3 style="text-align:center">Votos en Blanco</h3> 
          </a>
          <p>¿Van para la mayoría? ¿Son lo mismo que el voto nulo? ¿Como afectan?</p>
      </div>
      <div class="medium-3 columns">
        <a href="circunscripcion.php">  
             <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/mapa1.png">
             <h3 style="text-align:center">Circunscripción</h3> 
        </a>
          <p>¿Qué tipo de circunscripción se usa? ¿Es más justa la provincial o la nacional?</p>
      </div>
      <div class="medium-3 columns">
        <a href="barrera.php">
             <img style="width=100%; padding-right:10px; padding-left:10px;" src="img/porciento1.png">
             <h3 style="text-align:center">Barrera Electoral</h3>
        </a>
          <p>¿Qué es esto? ¿Perjudica a los partidos mayoritarios o minoritarios?</p>
      </div>
    </div>
      
    <footer>
        <hr>
        <h5 style="text-align:center;">Jorge Alonso Merchán - IPO USAL 2015</h5>
    </footer>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
