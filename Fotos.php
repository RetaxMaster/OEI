<?php session_start();
require("php/includes/db.php");
include("overall/session.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Fotos.css" type="text/css">
    <script src="js/Fotos.js" charset="utf-8"></script>
    <title>Fotos - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <!--  Ventana Modal  -->
    <div class="vmodal">
      <div class="col-md-2"></div>
      <span class="glyphicon glyphicon-remove pull-right" id="cerrar"></span>
      <div class="contenido contenedores col-xs-12 col-md-8">
        <span class="glyphicon glyphicon-chevron-left flechas" id="Anterior"></span>
        <img src="#" alt="Imagen Grande" name="#"/>
        <span class="glyphicon glyphicon-chevron-right flechas" id="Siguiente"></span>
      </div>
      <div class="col-md-2"></div>
    </div>
    <!--  Ventana Modal  -->
    <header>
      <?php include("overall/nav.php"); ?>
      <?php
if(!isset($_SESSION["usuario"])){
include("overall/loginRegister.php");
}
 ?>
    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10 contenedores main">
          <div class="presentacion">
            <h2>Fotos</h2>
            <br>
            <p>
              <?php

              if (isset($_SESSION["usuario"])) {
                $Nombre = $_SESSION["usuario"];
                $db = new Conexion();
                $datos = $db->query("SELECT Nombre,Sexo FROM usuarios WHERE Usuario='$Nombre'");
                $dato = $db->recorrer($datos);
                $Nombre = $dato["Nombre"];
                if ($dato["Sexo"] == "Femenino") {
                  echo "¡Bienvenida de nuevo $Nombre!";
                }
                else{
                echo "¡Bienvenido de nuevo $Nombre!";
              }
              }
              else{
                echo "¡Bienvenido de nuevo Alumno de la OEI!";
              }
               ?> En esta galería podrás ver todas las fotos de los alumnos de la OEI y de los Ex-OEI's, ¡Atrevete a aparecer aquí =D! Concursa en la OMI y los asesores tomarán foto de todo lo que ocurra aquí, ¡Y claro, subirán fotos!
            </p>
          </div>
          <div class="fotos">
            <?php
            $db = new Conexion();
            $images = $db->query("SELECT Imagen FROM publicaciones ORDER BY id DESC");
            $c = 0;
            while ($Imagenes = $db->recorrer($images)) {
              $img = $Imagenes["Imagen"];
              if (!empty($img)) {
              echo "<div class='col-sm-4 col-md-3 foto'>
                <img src='images/$img' alt='Foto' id='".++$c."'/>
              </div>";
              }
            }

             ?>
              <!--<div class="col-sm-4 col-md-3 foto">
                <img src="images/foto.jpg" alt="Foto" id="1"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/foto2.jpg" alt="Foto" id="2"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/foto3.jpg" alt="Foto" id="3"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/foto4.jpg" alt="Foto" id="4"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/foto5.jpg" alt="Foto" id="5"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/header.jpg" alt="Foto" id="6"/>
              </div>
              <div class="col-sm-4 col-md-3 foto">
                <img src="images/logo.jpg" alt="Foto" id="7"/>
              </div>-->
          </div>
        </div>
        <div class="col-xs-1"></div>
      </section>
    </section>
    <footer>
      <?php
      if(isset($_SESSION["usuario"])){ include("overall/notificaciones.php");
    }
      ?>
    </footer>
  </body>
</html>
