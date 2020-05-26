<?php
session_start();
require("php/includes/db.php");
include("overall/session.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <title>Tema - Olimpiada Escolar de Informática</title>
    <style media="screen">
    .imagen {
      display: inline-block;
      margin-bottom: 20px;
    }

    .imagen, img {
      width: 100%;
    }

    .main {
      margin-bottom: 15px;
    }
    </style>
  </head>
  <body>
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
        <div class="col-md-1"></div>
        <div class="col-md-10 contenedores main">
          <!--Contenido de ejemplo
          <h2>Hola</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <div class="imagen">
            <div class="col-sm-3 col-md-2"></div>
            <div class="col-sm-6 col-md-8">
              <img src="images/foto2.jpg" alt="asd" />
            </div>
          <div class="col-sm-3 col-md-2"></div>
          </div>
          Contenido de ejemplo-->
          <?php

          if(isset($_GET["tema"])){
          $tema = "Tema.php?tema=".$_GET["tema"];
          $db = new Conexion();
          $datos = $db->query("SELECT Contenido FROM ayuda WHERE url='$tema'");
          $dato = $db->recorrer($datos);
          if($db->filas($datos) > 0){
          echo $dato["Contenido"];
          }
          else{
            echo "<script type='text/javascript'>
              location.href = 'Ayuda.php';
            </script>";
          }
          }
          else{
            echo "<script type='text/javascript'>
              location.href = 'Ayuda.php';
            </script>";
          }

          ?>

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
