<?php
session_start();

require("php/includes/db.php");
include("overall/session.php");

if(!isset($_SESSION["usuario"])){
  header("location: ./");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Configuracion.css" type="text/css">
    <script src="js/Configuracion.js" charset="utf-8"></script>
    <script src="js/Fotos.js" charset="utf-8"></script>
    <title>Configuración - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <div class="vmodal" id="ImgGrande">
      <div class="col-md-2"></div>
      <span class="glyphicon glyphicon-remove pull-right" id="cerrar"></span>
      <div class="contenido contenedores col-xs-12 col-md-8">
        <img src="#" alt="Imagen Grande" name="#"/>
      </div>
      <div class="col-md-2"></div>
    </div>
    <header>
      <?php include("overall/nav.php"); ?>
      <?php
if(!isset($_SESSION["usuario"])){
include("overall/loginRegister.php");
}
else {
  echo "<div class='vmodalC' id='VentanaEspera'>
    <div class='col-xs-1 col-md-3'></div>
    <div class='contenido contenedores col-xs-10 col-md-6'>
      <h4>Estamos procesando su solcitud, esto puede tardar varios segundos, espera un momento por favor...</h4>
      <img src='images/loader.gif' alt='Gif de carga' />
    </div>
    <div class='col-xs-1 col-md-3'></div>
  </div>";
}
 ?>
    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 contenedores main">
          <div class="presentacion">
            <div class="header">
          <form class="input-group busqueda col-sm-6 pull-right" id="BusquedaUsers" action="#" method="post">
      <input type="text" id="user" class="form-control" placeholder="¿Deseas buscar a alguien?">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" id="find">Go!</button>
      </span>
    </form><!-- /input-group -->
    <div class="visible-xs col-xs-12 sep"></div>
          <h2 class="col-sm-6 title">Configuración</h2>
            </div>
          <br>
          <p>
            <?php

            if (isset($_SESSION["usuario"])) {
            $Usuario = $_SESSION["usuario"];
            $db = new Conexion();
            $datos = $db->query("SELECT Nombre,Sexo,Usuario FROM usuarios WHERE Usuario='$Usuario'");
            $dato = $db->recorrer($datos);
            $Nombre = $dato["Nombre"];
            $Sexo = $dato["Sexo"];
            $Usuario = $dato["Usuario"];

            if ($Sexo == "Femenino") {
              $Sexo = "¡Bienvenida <span id='Nom' name='$Usuario'>";
            }
            else {
              $Sexo = "¡Bienvenido <span id='Nom' name='$Usuario'>";
            }

            echo $Sexo.$Nombre."</span>!";
            }
            else {
              echo "¡Bienvenido Usuario de la OEI!";
            }


             ?>, Aquí podrás configuar tu perfil como alumno de la Olimpiada Escolar de Informática, lamentablemente solo te permitimos cambiar tu foto de perfil y tu contraseña por motivos de seguridad :(
          </p>
          </div>
          <br>
          <div class="configuracion">
            <div class="foto col-xs-12 col-sm-4 col-md-3" id="foto">
              <form class="foto" action="#" enctype="multipart/form-data" id="cpicture" method="post">
              <input type="file" name="file" id="cambiar">
              </form>
              <span class="glyphicon glyphicon-pencil" id="change"></span>
              <img src="" alt="Foto de Perfil" id="FotoDePerfil" name="foto"/>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
            <b>Nombre: </b><span id="Nombre"></span><br>
            <b>Edad: </b><span id="Edad"></span> <br>
            <b>Sexo: </b><span id="Sexo"></span><br>
            <b>Nombre de Usuario: </b><span id="Usuario"></span><br>
            <b>Semestre cursando actualmente: </b><span id="Semestre"></span><br>
            <b>Especialidad: </b><span id="especialidad"></span><br>
            <b>Fecha de cumpleaños: </b><span id="fecha"></span><br>
            <b>Usuario de OmegaUp: </b><span id="omega"></span><br>
            <b>Dependencia: </b><span id="Dependencia"></span><br>
            <b>Score: </b><span id="score"></span><br>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-5 cp">
              <form class="changeP" action="#" method="post">
                <h4>Cambiar Contraseña:</h4>
                  <label for="ca">Contraseña Actual</label>
                  <input type="password" id="ca" class="form-control" placeholder="Contraseña Actual">
                <br>
                  <label for="nc">Nueva Contraseña</label>
                  <input type="password" id="nc" class="form-control" placeholder="Nueva Contraseña"><br>
                  <label for="rc">Repetir Contraseña</label>
                  <input type="password" id="rc" class="form-control" placeholder="Repetir Contraseña"><br>
                  <input type="submit" name="change" value="Cambiar" id="Cambiar">
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
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
