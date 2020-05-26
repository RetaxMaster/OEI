<?php session_start();
require("php/includes/db.php");
include("overall/session.php");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Problemas.css" media="screen" type="text/css">
    <script src="js/Problemas.js" charset="utf-8"></script>
    <title>Problemas - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <?php

    if(isset($_SESSION["rol"])){
      if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
        include("overall/espera.php");
        echo "<!--  Ventana Modal  -->
        <div class='vmodal' id='sure'>
          <div class='col-xs-1 col-md-3'></div>
          <div class='contenido contenedores col-xs-10 col-md-6'>
            <h3>¿Seguro que deseas eliminar este problema?</h3>
            <div class='botones'>
              <div class='btn1'>
              <button type='button' name='si' id='si'>Si</button>
              </div>
              <div class='btn2'>
              <button type='button' name='no' id='no'>No</button>
              </div>
            </div>
          </div>
          <div class='col-xs-1 col-md-3'></div>
        </div>
        <!--  Ventana Modal  -->
        <!-- Ventana modal del boton -->
        <div class='vmodalButtonPlus'>
          <div class='col-xs-1 col-md-3'></div>
          <div class='contenido contenedores col-xs-10 col-md-6'>
            <div class='closeP pull-right'>
            <span class='glyphicon glyphicon-remove' id='cerrarP'></span>
            </div>
            <div class='mainP'>
            <form class='nuevoProblema' action='#' method='post'>
              <label for='nProblema'>Ingrese el nombre del problema:</label>
              <br>
              <input type='text' name='nombre' id='nProblema'><br>
              <label for='Lenguajes'>Describa los lenguajes que maneja el problema:</label>
              <br>
              <input type='text' name='Lenguajes' id='Lenguajes'><br>
              <label for='Enlace'>Ingrese la URL del problema:</label>
              <br>
              <input type='text' name='Enlace' id='Enlace'>
              <label for='Descripcion'>Brinde una breve descripción del problema: (Puede ser la misma que está en el problema de OmegaUp)</label>
              <br>
              <textarea name='Descripcion' id='Descripcion'></textarea>
              <input type='button' name='agregar' id='agregar' value='Agregar Problema'>
            </form>
            </div>
          </div>
          <div class='col-xs-1 col-md-3'></div>
        </div>
        <!-- Ventana modal del boton -->";
      }
    }
    ?>

    <header>
      <?php include("overall/nav.php"); ?>
    <?php
if(!isset($_SESSION["usuario"])){
include("overall/loginRegister.php");
}
 ?>
    </header>
    <section class="container-fluid">
      <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10 contenedores main">
          <div class="Presentacion">
            <?php

            if (isset($_SESSION["usuario"])) {
              $Nombre = $_SESSION["usuario"];
              $db = new Conexion();
              $datos = $db->query("SELECT Nombre,Sexo FROM usuarios WHERE Usuario='$Nombre'");
              $dato = $db->recorrer($datos);
              $Nombre = $dato["Nombre"];
              if ($dato["Sexo"] == "Femenino") {
                echo "<h2>¡Bienvenida $Nombre!</h2>";
              }
              else{
              echo "<h2>¡Bienvenido $Nombre!</h2>";
            }
            }
            else{
              echo "<h2>¡Bienvenido Alumno de la OEI!</h2>";
            }

             ?>
          <br>
          <p>
            Aca podrás consultar ejercicios de algunas sesiones de la Olimpiada Escolar de Informática de la Escuela Miguel Hidalgo, estos ejercicios se resuleven a través de la página <a target="_blank" href="https://omegaup.com/"><b>OmegaUp</b></a> misma en la cuál podrás encontrar cientos de ejercicios muy a parte de los que te ofrecemos aquí, esta página tiene soporte pára varios lenguajes <b>(Karel Pascal, Karel Java, C,  C++, Java, Python, Ruby, etc.)</b> si eres lo suficientemente autodidacta te invitamos a que resuelvas por tu propia cuenta diversos ejercicios proporcionados por la misma página.
          </p>
          <p>
            Antes de iniciar es necesario que estes registrado en la página, de <b>OmegaUp</b>, tanto como en nuestra página de la <b>Olimpiada Escolar de Informática (OEI)</b>, te sugerimos que también te registres en la página oficial de la <b>Olimpiada Méxicana de Informática (OMI)</b>, ya que es aquí en donde se presentara el examen de admisión en línea.
          </p>
          <p>
            Si aún no estás registrado puedes registrarte a continuación a través de los siguietnes links:
          </p>
          <p>
            <a target="_blank" href="https://omegaup.com/login/"><b>Registrarme en OmegaUp</b></a><br><br class="visible-xs">
            <?php

            if (!isset($_SESSION["usuario"])) {
              echo "<a id='reg' href='#'><b>Registrarme en la Olimpiada Escolar de Informática (OEI)</b></a><br><br class='visible-xs'>";
            }

             ?>
            <a target="_blank" href="http://www.olimpiadadeinformatica.org.mx/OMI/Ingreso/RegistroCorreo.aspx"><b>Registrarme en la Olimpiada Mexicana de Informática (OMI)</b></a>
          </p>
          </div>
          <br>
          <div class="Problemas">
            <h2>Problemas:</h2>
            <?php
            if (isset($_SESSION["usuario"])) {
            $db = new Conexion();
            $datos = $db->query("SELECT * FROM problemas ORDER BY id DESC;");
            if ($db->filas($datos) > 0) {
            while ($campos = $db->recorrer($datos)) {
              $Nombre = $campos["Nombre"];
              $Lenguajes = $campos["Lenguajes"];
              $Descripcion = $campos["Descripcion"];
              $url = $campos["url"];
              $id = $campos["id"];

              echo "<div class='problema' id='$id'>
                <a target='_blank' href='$url'>
                  <div class='headerProb'>
                    <h4>$Nombre<span class='lenguajes'> $Lenguajes</span></h4>";
                    if (isset($_SESSION["rol"])) {
                      if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                        echo "<div class='eliminar'>
                          <span class='glyphicon glyphicon-remove pull-right'></span>
                        </div>";
                      }
                    }
                  echo "</div>
                  <div class='contenido'>
                <p>
                  $Descripcion
                </p>
                  </div>
                </a>
              </div>";
            }
          }
          }
             ?>
          </div>
        </div>
        <div class="col-xs-1"></div>
      </div>
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
