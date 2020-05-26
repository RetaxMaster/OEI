<?php
session_start();
if(isset($_GET["salir"])){
  session_destroy();
  setcookie("usuario", "nada", time() - 60 * 60 *24 * 365, "/");
  setcookie("rol", "nada", time() - 60 * 60 *24 * 365, "/");
  header("location: ./");
}
require("php/includes/db.php");
include("overall/session.php");

//Área destinada a actualizar los cumpleaños
$db = new Conexion();
$datos = $db->query("SELECT Cumpleaños,FechaActualizada,Usuario FROM usuarios;");
$dia = date("d");
$mes = date("m");
$anio = date("Y");

while ($dato = $db->recorrer($datos)) {
  $Act = $dato["FechaActualizada"];
  $usuario = $dato["Usuario"];
  $cumple = explode("-", $dato["Cumpleaños"]);
  $edad = date("Y") - $cumple[0];
  $edad--;
  if (date("m") >= $cumple[1]) {
    if ($Act == "NoActualizada") {
    if (date("m") > $cumple[1]) {
      $edad++;
      $db->query("UPDATE usuarios SET Edad='$edad' WHERE Usuario='$usuario';");
      $db->query("UPDATE usuarios SET FechaActualizada='Actualizada' WHERE Usuario='$usuario';");
    }
    else if (date("d") >= $cumple[2]) {
      $edad++;
      $db->query("UPDATE usuarios SET Edad='$edad' WHERE Usuario='$usuario';");
      $db->query("UPDATE usuarios SET FechaActualizada='$str' WHERE Usuario='$usuario';");
    }
    }
  }
  elseif($Act == "Actualizada") {
    $db->query("UPDATE usuarios SET FechaActualizada='NoActualizada' WHERE Usuario='$usuario';");
  }

}
//-> Área destinada a actualizar los cumpleaños


 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <script src="js/index.js" charset="utf-8"></script>
    <title>Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <header>
      <!-- Aqui se hace la imagen grande -->
      <div class="vmodal" id="ImagenGrande">
        <div class="col-md-2"></div>
        <span class="glyphicon glyphicon-remove pull-right" id="cerrarImg"></span>
        <div class="contenido contenedores col-xs-12 col-md-8">
          <img src="#" alt="Imagen Grande" name="#"/>
        </div>
        <div class="col-md-2"></div>
      </div>
      <!-- ->Aqui se hace la imagen grande -->
      <?php
      include("overall/espera.php");
      if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
          echo "<!--  Ventana Modal  -->
          <div class='vmodal' id='sure'>
            <div class='col-xs-1 col-md-3'></div>
            <div class='contenido contenedores col-xs-10 col-md-6'>
              <h3>¿Seguro que deseas eliminar esta publicación?</h3>
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
      }

      if(isset($_SESSION["usuario"]) and isset($_SESSION["rol"])){
        if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
        echo "<!--  Ventana Modal  -->
        <div class='vmodal' id='addAses'>
          <div class='col-md-4'></div>
          <div class='contenido contenedores col-xs-12 col-md-4'>
          <span class='glyphicon glyphicon-remove pull-right' id='cerrar'></span>";
        if($_SESSION["usuario"] == "carlos052" and $_SESSION["rol"] == "Administrador" or $_SESSION["usuario"] == "jean12333" and $_SESSION["rol"] == "Administrador"){
          echo "
            <form class='nuevoAsesor' action='#' method='post'>
              <label for='newAsesor'>Ingrese el nombre de usuario:</label><br>
              <input type='text' name='newAsesor' id='newAsesor'><br><br>
              <input type='submit' id='goAsesor' class='AdminButton' value='Hacer Asesor'>
            </form>
            <form class='eliminarAsesor' action='#' method='post'>
              <label for='delAsesor'>Ingrese el nombre de usuario:</label><br>
              <input type='text' name='delAsesor' id='delAsesor'><br><br>
              <input type='submit' id='elAsesor' class='AdminButton' value='Eliminar Asesor'>
            </form>";
        }
        echo "<form class='nuevoAlum' action='#' method='post'>
          <label for='newAlumn'>Ingrese el nombre de usuario:</label><br>
          <input type='text' name='newAlumn' id='newAlumn'><br><br>
          <input type='submit' id='goAlumn' class='AdminButton' value='Agregar Alumno'>
        </form>
        <form class='eliminarAlumn' action='#' method='post'>
          <label for='delAlumn'>Ingrese el nombre de usuario:</label><br>
          <input type='text' name='delAlumn' id='delAlumn'><br><br>
          <input type='submit' id='elAlumno' class='AdminButton' value='Eliminar Alumno'>
        </form>";
        echo "</div>
        <div class='col-md-4'></div>
      </div>
      <!--  Ventana Modal  -->";
      }
      }
      ?>

      <div class="encabezado">
        <img src="images/header.jpg" alt="Header" />
      </div>
      <?php
      if(!isset($_SESSION["usuario"])){
      echo "<button type='button' id='registro'>¡Registrarme!</button>";
      }
       ?>

      <?php include("overall/nav.php"); ?>
    <?php
    if(!isset($_SESSION["usuario"])){
    include("overall/loginRegister.php");
    }
     ?>
    </header>
    <section id="main">
      <section class="container-fluid">
        <div class="row">
          <div class="col-md-2">
            <div class="sede contenedores">
              <h4>Lugar de la próxima sede: <?php
              $db = new Conexion();
              $datos = $db->query("SELECT Lugar FROM sedes ORDER BY id DESC LIMIT 1");
              $dato = $db->recorrer($datos);
              echo $dato["Lugar"];
               ?></h4>

              <?php
              if (isset($_SESSION["rol"])){
                if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
                  echo "<div class='actSede'><br>
                    <form id='sed' action='#' method='post'>
                      <input type='text' name='lug' id='lug'><br><br>
                      <input type='submit' id='est' value='Listo'>
                    </form>
                  </div>";
                }
              }
              ?>
            </div>
              <?php

              if (isset($_SESSION["usuario"])) {
                echo "<div class='contenedores Nots'>";
                $db = new Conexion();
                $usuario = $_SESSION["usuario"];
                $datos = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
                echo "<div id='Titulo'>
                  <h4>";
                  if ($db->filas($datos) == 0) {
                    echo "No tienes notificaciones nuevas.";
                  }
                  else {
                    echo "¡Tienes ".$db->filas($datos)." notificaciones!";
                  }
                  echo "</h4>
                </div>";
                echo "<div id='Nots'>";
                if ($db->filas($datos) > 0) {
                  while ($dato = $db->recorrer($datos)) {
                    $Remitente = $dato["Remitente"];
                    $datos2 = $db->query("SELECT Rol FROM usuarios WHERE Usuario='$Remitente';");
                    $dato2 = $db->recorrer($datos2);
                    if ($dato2["Rol"] == "Administrador" or $dato2["Rol"] == "Asesor") {
                      $Remitente = "[".$dato2["Rol"]."] ".$Remitente;
                    }
                    $id = $dato["id"];
                    if ($dato["Asunto"] == "Comentario") {
                      $Asunto = "te ha mencionado en un comentario";
                    }
                    echo "<a href='Comentarios.php' class='notfContenedor contenedores' id='notf-$id'>
                          <span class='glyphicon glyphicon-remove pull-right'></span>
                        <p>$Remitente $Asunto</p>
                    </a>";
                  }
                  }
                echo "</div>";
            echo "</div>";
              }

               ?>

          </div>
          <div class="contenido indexado col-md-9">
            <?php

            if(isset($_SESSION["rol"])){
              if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
                echo "<!-- Nuevo Artículo -->
                <div id='publicacion' class='contenedores'>
                  <form class='publicacion' id='formPubaAdm' action='#' enctype='multipart/form-data' method='post'>
                    <textarea name='name' placeholder='Escribe una nueva publicación...'></textarea>
                    <button class='pull-right' type='button' name='listo' id='Publicar'>Publicar</button>
                    <input type='file' name='file' id='imgPublic'>
                  </form>
                </div>
                <div id='Publicaciones'>
                <!-- ->Nuevo Artículo -->";
              }
            }

             ?>

             <!-- Artículos -->
             <div class="Publicaciones">

             <?php

             $db = new Conexion();
             $datos = $db->query("SELECT * FROM publicaciones ORDER BY id DESC LIMIT 0, 10;");
             if ($db->filas($datos) > 0) {
             while ($campos = $db->recorrer($datos)) {
               $Publicacion = $campos["Publicacion"];
               $Fecha = $campos["Fecha"];
               $Imagen = $campos["Imagen"];
               $id = $campos["id"];
               echo "<div class='articulo contenedores' id='$id'>
                 <div class='header'>
                   <div class='fecha'>
                   <h5 class='FechaPub'>$Fecha</h5>
                   </div>";

                   if (isset($_SESSION["rol"])) {
                     if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                       echo "<div class='cerrar'>
                       <span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>
                       </div>";
                     }
                   }
                 echo "</div>";
                 if(!empty($Publicacion)){
                 echo "<p>$Publicacion</p>";
                  }
                 if (!empty($Imagen)) {
                   echo "<div class='image'><div class='col-sm-1'></div>
                   <div class='imagen col-sm-10 foto'>
                     <img src='images/$Imagen' alt='Imagen' />
                   </div>
                   <div class='col-sm-1'></div></div>";
                 }
                 echo "</div>";
             }
           }
              ?>


              </div>
          <!-- ->Artículos -->
        </div>
              <div class="contenedores" id="Paginacion">
                <span class="glyphicon glyphicon-triangle-bottom"></span>
              </div>
          </div>
          <div class="col-md-1"></div>
        </div>
      </section>
    </section>
    <footer>
      <?php
      if(isset($_SESSION["usuario"]) and isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
          include("overall/botonAgregar.php");
        }
      include("overall/notificaciones.php");
      }

      ?>
    </footer>
  </body>
</html>
