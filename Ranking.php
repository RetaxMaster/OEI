<?php session_start(); require("php/includes/db.php"); include("overall/session.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Ranking.css" type="text/css">
    <script src="js/Ranking.js" charset="utf-8"></script>
    <title>Ranking - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <header>
      <?php include("overall/nav.php"); ?>
    <?php
    if(!isset($_SESSION["usuario"])){
    include("overall/loginRegister.php");
    }

    if(isset($_SESSION["rol"])){
      if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
        include("overall/espera.php");
    echo "<!--  Ventana Modal  -->
    <div class='vmodal' id='Na'>
      <div class='col-md-4'></div>
      <div class='contenido contenedores col-xs-12 col-md-4'>
      <span class='glyphicon glyphicon-remove pull-right' id='cerrar'></span>
      <div class='cont'>
        <form class='exoei' action='#' method='post'>
          <label for='NombreN'>Nombre:</label><br>
          <input type='text' name='NombreN' id='NombreN'><br>
          <label for='SemestreN'>Semestre:</label><br>
          <input type='text' name='SemestreN' id='SemestreN'><br>
          <div class='especialidad'>
          <h4>Especialidad</h4>
          <div class='radios'>
          <input type='radio' name='especialidad' id='p' value='Programación'>
          <label for='p'>Técnico Programador </label>
          </div>
          <div class='radios'>
          <input type='radio' name='especialidad' id='diet' value='Dietética'>
          <label for='diet'>Dietista </label>
          </div>
          <div class='radios'>
          <input type='radio' name='especialidad' id='ts' value='Trabajo Social'>
          <label for='ts'>Trabajo Social </label>
          </div>
          <div class='radios'>
          <input type='radio' name='especialidad' id='sec' value='Secundaria'>
          <label for='sec'>Secundaria </label>
          </div>
          </div>
          <label for='LugarN'>Lugar de la Sede:</label><br>
          <input type='text' name='LugarN' id='LugarN'><br>
          <label for='PosicionN'>Posición:</label><br>
          <input type='text' name='PosicionN' id='PosicionN'><br>
          <label for='AnioN'>Año:</label><br>
          <input type='text' name='AnioN' id='AnioN'><br>
          <label for='PuntajeN'>Puntaje:</label><br>
          <input type='text' name='PuntajeN' id='PuntajeN'><br>
          <input type='button' name='agregarAl' id='agregarAl' value='Agregar'>
        </form>
      </div>
      </div>
      <div class='col-md-4'></div>
    </div>
    <!--  Ventana Modal  -->";
    }
  }
    ?>
    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 contenedores main">
          <div class="Presentacion">
            <h2>Descripción:</h2>
            <br>
            <p>
              ¡Bienvenido! Aquí podrás encontrar el ranking de Ex-OEI's, ¿Ex-OEI's? ¿A qué nos referimos? Los Ex-OEI's son alumnos que antes pertenecieron a la <b>Olimpiada Escolar de Informática (OEI)</b>, los alumnos que aparecen registrados aquí son aquellos que consiguieron ir a la <b>Olimpiada Mexicana de Informática (OMI)</b> a nivel nacional y quedaron en un lugar más alto que los otros 2, en este Ranking solo consideramos a los alumnos de la OEI de la Escuela Miguel Hidalgo en Tabasco, si deseas ver tu nombre aquí deberás dar tu mayor esfuerzo y salir adelante para llegar a concursar a nivel nacional.
            </p>
            <h3>¡Mucha Suerte!</h3>
          </div>
          <br>
          <div id="rank">

          </div>
        </div>
        <div class="col-md-1"></div>
      </section>
    </section>
    <footer>
      <?php
      if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
      include("overall/botonAgregar.php");
        }
      }

      if(isset($_SESSION["usuario"])){ include("overall/notificaciones.php");
    }

      ?>
    </footer>
  </body>
</html>
