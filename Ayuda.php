<?php session_start();
require("php/includes/db.php");
include("overall/session.php");
$db = new Conexion();
if(!isset($_SESSION["usuario"])){
  header("location: ./");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Ayuda.css" type="text/css">
    <script src="js/Ayuda.js" charset="utf-8"></script>
    <title>Ayuda - Olimpiada Escolar de Informática</title>
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
      <div class='vmodal' id='nt'>
        <div class='col-md-4'></div>
        <div class='contenido contenedores col-xs-12 col-md-4'>
        <span class='glyphicon glyphicon-remove pull-right' id='cerrar'></span>
          <form class='NuevoTema' action='#' method='post' id='NuevoTema'>
            <label for='Tema'>Nombre del Tema:</label><br>
            <input type='text' name='Tema' id='Tema'><br>
            <label for='campo'>Selecciona el campo:</label><br>
            <select name='campo' form='NuevoTema' id='campo'>
              <option value=''>Seleccionar Tema</option>
              <option value='Kp'>Karel Pascal</option>
              <option value='Kj'>Karel Java</option>
              <option value='Cpp'>C++</option>
              <option value='Libinteractive'>Libinteractive</option>
              <option value='Robotica'>Robótica</option>
            </select><br>
            <h3>Crea el contenido:</h3><br>
            <div class='botonesAgregar container-fluid'>
              <div class='row'>
                <div class='col-xs-12 col-sm-3'>
                  <input type='button' name='h2' value='Título' id='h2'>
                </div>
                <div class='col-xs-12 col-sm-3'>
                  <input type='button' name='h4' value='Subtitulo' id='h4'>
                </div>
                <div class='col-xs-12 col-sm-3'>
                  <input type='button' name='img' value='Imagen' id='img'>
                </div>
                <div class='col-xs-12 col-sm-3'>
                  <input type='button' name='p' value='Texto' id='parr'>
                </div>
              </div>
            </div><br>
            <div class='inputs'>
            </div>
            <br>
            <input type='button' name='AgregarTema' id='AgregarTema' value='Agregar Tema'>
          </form>
        </div>
        <div class='col-md-4'></div>
      </div>
      <!--  Ventana Modal  -->
      <!--  Ventana Modal  -->
      <div class='vmodal' id='sure'>
        <div class='col-xs-1 col-md-3'></div>
        <div class='contenido contenedores col-xs-10 col-md-6'>
          <h3>¿Seguro que deseas eliminar esta ayuda?</h3>
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
      ?>
    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10 contenedores main">
          <div class="presentacion">
            <h2>Ayuda:</h2>
            <br>
            <p>
              Hola de nuevo <?php

              if (isset($_SESSION["usuario"])) {
                $Nombre = $_SESSION["usuario"];
                $db = new Conexion();
                $datos = $db->query("SELECT Nombre,Sexo FROM usuarios WHERE Usuario='$Nombre'");
                $dato = $db->recorrer($datos);
                $Nombre = $dato["Nombre"];
                echo $Nombre;
              }
              else {
                echo "Alumno de la OEI";
              }

               ?>, aquí podrás encontrar ayuda sobre diversos temas desarrollados en las sesiones de la <b>Olimpiada Escolar de Informática (OEI)</b>, esta sección está dividida en temarios los cuales son los temas que se ven día a día en las sesiones de clase, como podrás observar algunos temarios estan bloqueados, esto se debe a que se irán desbloqueando a medida que transcurre la OEI, contamos con un temario de Karel, C++ y Libinteractive los cuales son los temas que se verán aquí en la OEI, si tienes alguna duda siempre puedes acudir aquí, ¡Suerte!
            </p>
          </div>
          <div class="ayuda">
            <div class="tema">
              <h3 class="Tdesbloqueado" id="Karel">Karel</h3>
              <div class="contenidoP">
                <div class="subtema">
                  <h4 id="Kp">Karel Pascal</h4>
                  <div class="contenido" id="CKp">
                    <?php


                    $datos = $db->query("SELECT * FROM ayuda;");
                    if ($db->filas($datos) > 0) {
                      $c =0;
                    while ($campos = $db->recorrer($datos)) {
                      $Nombre = $campos["Nombre"];
                      $url = $campos["url"];
                      $Dependencia = $campos["Dependencia"];
                      $id = $campos["id"];

                      if ($Dependencia == "Kp") {
                        $c++;
                        echo "<a target='_blank' href='$url' id='$id'>";

                        if ($c == 1) {
                        echo "<div class='seccion top'>
                          <h5>$Nombre";
                        }
                        else {
                          echo "<div class='seccion'>
                            <h5>$Nombre";
                        }


                          if (isset($_SESSION["rol"])) {
                            if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                              echo "<span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>";
                            }
                          }
                           echo "</h5>
                        </div></a>";
                      }
                    }}

                     ?>
                  </div>
                </div>
                <div class="subtema">
                  <h4 id="Kj">Karel Java</h4>
                  <div class="contenido" id="CKj">
                    <?php


                    $datos = $db->query("SELECT * FROM ayuda;");
                    if ($db->filas($datos) > 0) {
                      $c = 0;
                    while ($campos = $db->recorrer($datos)) {
                      $Nombre = $campos["Nombre"];
                      $url = $campos["url"];
                      $Dependencia = $campos["Dependencia"];
                      $id = $campos["id"];

                      if ($Dependencia == "Kj") {
                        $c++;
                        echo "<a target='_blank' href='$url' id='$id'>";

                        if ($c == 1) {
                        echo "<div class='seccion top'>
                          <h5>$Nombre";
                        }
                        else {
                          echo "<div class='seccion'>
                            <h5>$Nombre";
                        }


                          if (isset($_SESSION["rol"])) {
                            if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                              echo "<span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>";
                            }
                          }
                           echo "</h5>
                        </div></a>";
                      }
                    }}

                     ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="tema">
              <h3 id="Cpp">C++</h3>
              <div class="contenido" id="Ccpp">
                <?php


                $datos = $db->query("SELECT * FROM ayuda;");
                if ($db->filas($datos) > 0) {
                  $c = 0;
                while ($campos = $db->recorrer($datos)) {
                  $Nombre = $campos["Nombre"];
                  $url = $campos["url"];
                  $Dependencia = $campos["Dependencia"];
                  $id = $campos["id"];

                  if ($Dependencia == "Cpp") {
                    $c++;
                    echo "<a target='_blank' href='$url' id='$id'>";


                    if ($c == 1) {
                    echo "<div class='seccion top'>
                      <h5>$Nombre";
                    }
                    else {
                      echo "<div class='seccion'>
                        <h5>$Nombre";
                    }


                      if (isset($_SESSION["rol"])) {
                        if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                          echo "<span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>";
                        }
                      }
                       echo "</h5>
                    </div></a>";
                  }
                }}

                 ?>
                <!--<a class="bloqueado" target="_blank" href="Tema.php"><div class="seccion top">
                  <h5>Introducción</h5>
                </div></a>-->
              </div>
            </div>
            <div class="tema">
              <h3 id="Libinteractive">Libinteractive</h3>
              <div class="contenido" id="Lb">
                <?php


                $datos = $db->query("SELECT * FROM ayuda;");
                if ($db->filas($datos) > 0) {
                  $c = 0;
                while ($campos = $db->recorrer($datos)) {
                  $Nombre = $campos["Nombre"];
                  $url = $campos["url"];
                  $Dependencia = $campos["Dependencia"];
                  $id = $campos["id"];

                  if ($Dependencia == "Libinteractive") {
                    $c++;
                    echo "<a target='_blank' href='$url' id='$id'>";
                    if ($c == 1) {
                    echo "<div class='seccion top'>
                      <h5>$Nombre";
                    }
                    else {
                      echo "<div class='seccion'>
                        <h5>$Nombre";
                    }

                      if (isset($_SESSION["rol"])) {
                        if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                          echo "<span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>";
                        }
                      }
                       echo "</h5>
                    </div></a>";
                  }
                }}

                 ?>
              </div>
            </div>
            <div class="tema">
              <h3 id="Robotica">Robótica</h3>
              <div class="contenido" id="Rb">
                <?php


                $datos = $db->query("SELECT * FROM ayuda;");
                if ($db->filas($datos) > 0) {
                  $c = 0;
                while ($campos = $db->recorrer($datos)) {
                  $Nombre = $campos["Nombre"];
                  $url = $campos["url"];
                  $Dependencia = $campos["Dependencia"];
                  $id = $campos["id"];

                  if ($Dependencia == "Robotica") {
                    $c++;
                    echo "<a target='_blank' href='$url' id='$id'>";
                    if ($c == 1) {
                    echo "<div class='seccion top'>
                      <h5>$Nombre";
                    }
                    else {
                      echo "<div class='seccion'>
                        <h5>$Nombre";
                    }

                      if (isset($_SESSION["rol"])) {
                        if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                          echo "<span class='glyphicon glyphicon-remove pull-right EliminarPub'></span>";
                        }
                      }
                       echo "</h5>
                    </div></a>";
                  }
                }}

                 ?>
              </div>
            </div>
          </div>
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
