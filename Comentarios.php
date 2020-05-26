<?php

session_start();
require("php/includes/db.php");
include("overall/session.php");
set_time_limit(0);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Comentarios.css" type="text/css">
    <script src="js/Comentarios.js" charset="utf-8"></script>
    <title>Comentarios - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <header>
      <!--  Ventana Modal  -->
      <div class="vmodal" id="ModalFotos">
        <div class="col-md-2"></div>
        <span class="glyphicon glyphicon-remove pull-right" id="cerrarImg"></span>
        <div class="contenido contenedores col-xs-12 col-md-8">
          <img src="#" alt="Imagen Grande" name="#"/>
        </div>
        <div class="col-md-2"></div>
      </div>
      <!--  Ventana Modal  -->
      <?php
      include("overall/nav.php");
      if(!isset($_SESSION["usuario"])){
      include("overall/loginRegister.php");
      }

      include("overall/espera.php");
      if (isset($_SESSION["usuario"])) {
        echo "<!--  Ventana Modal  -->
        <div class='vmodal' id='sure'>
          <div class='col-xs-1 col-md-3'></div>
          <div class='contenido contenedores col-xs-10 col-md-6'>
            <h3>¿Seguro que deseas eliminar este comentario?</h3>
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
        <!--  Ventana Modal  -->";
      }
      ?>

    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 main">
          <?php

          if (isset($_SESSION["usuario"])) {
            echo "<div class='NuevoComent contenedores'>
            <form action='#' method='post' enctype='multipart/form-data' id='NuevoCom'>
              <textarea id='Comentarios' placeholder='Escribe tu comentario aquí...'></textarea><br>
              <input type='file' name='file' id='Img' class='pull-left'>
              <input type='button' id='pub' class='pull-right' value='Publicar'>
              </form>
            </div>";
          }
          else {
            echo "<div class='presentacion contenedores main'>
              <h3>¡Bienvenido!</h3><br>
              <p>
                En esta sección podrás publicar tus comentarios acerca de la página o si lo deseas podrás publicar alguna duda que tengas referente a la programación, a las sesiones de clases o a cualquier cosa que tenga que ver con la programación, ¡Hey! los asesores también somos personas, por ello te responderemos en cuanto un asesor vea tu comentario, puedes checar esta sección cuando gustes, para poder publicar un comentario es indispensable que estes registrado, por esto te invitamos a que te <a href='#' id='regs'>registres</a>, si ya estás registrado entonces puedes <a href='#' id='log'>loguearte</a>.
              </p>
            </div>";
          }

           ?>

          <div class="Comentarios">
            <?php
            $db = new Conexion();
            $datos = $db->query("SELECT * FROM comentarios ORDER BY id DESC LIMIT 0, 10");


            while ($campo = $db->recorrer($datos)) {
              $Nombre = $campo["Usuario"];
              $id = $campo["id"];
              $Fecha = $campo["Fecha"];
              $Comentario = $campo["Comentario"];
              $Rol = $campo["Rol"];
              $foto = $campo["Imagen"];
              $datos2 = $db->query("SELECT Foto FROM usuarios WHERE Usuario='$Nombre';");
              $datoListoFoto = $db->recorrer($datos2);
              $urlFoto = "images/".$datoListoFoto["Foto"];
              echo "<div class='contenedores comentario' id='$id'>
                <div class='Fecha'>
                <h5>$Fecha</h5>
                <h4>";

                echo "[$Rol] $Nombre:</h4>
                </div>";

                if (isset($_SESSION["usuario"])) {
                if ($Nombre == $_SESSION["usuario"] || $_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Asesor") {
                  if ($Rol != "Administrador" || $Nombre == $_SESSION["usuario"]) {
                echo "<div class='elim'>
                  <span class='glyphicon glyphicon-remove eliminar pull-right'></span>
                </div>";
                  }
                }
                }

                echo "<div class='coment'>
                <div class='imagen col-xs-3 col-sm-1'><img src='$urlFoto' alt='Foto de Perfil' /></div>
                <div class='comenta col-xs-9 col-sm-11'>";
                if (!empty($Comentario)) {
                  echo "<p>$Comentario</p>";
                }
                  if (!empty($foto)) {
                    echo "<div class='col-md-3'></div><div class='imagen col-md-6'>
                      <img src='images/$foto' />
                    </div><div class='col-md-3'></div>";
                  }
                  echo "</div>
                </div>
              </div>";
            }
            ?>
          </div>
          <div class="articulo contenedores" id="Paginacion">
            <span class="glyphicon glyphicon-triangle-bottom"></span>
          </div>
        </div>
        <div class="col-sm-1"></div>
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
