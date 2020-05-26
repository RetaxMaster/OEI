<?php session_start(); set_time_limit(0);
require("php/includes/db.php");
include("overall/session.php");
$db = new Conexion();
$datos = $db->query("SELECT Lugar FROM sedes ORDER BY id DESC LIMIT 1");
$dato = $db->recorrer($datos);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Alumnos.css" type="text/css">
    <script src="js/Alumnos.js" charset="utf-8"></script>
    <title>Ranking - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <header>
      <?php include("overall/nav.php"); ?>
    <?php
if(!isset($_SESSION["usuario"])){
include("overall/loginRegister.php");
}
else {
  if ($_SESSION["rol"] == "Administrador" || $_SESSION["rol"] == "Asesor") {
    include("overall/espera.php");
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
              ¡Bienvenido! Este es el Ranking de los alumnos actualmente inscritos a la <b>Olimpiada Escolar de Informática</b> aquí podrás consultar tu posición, ¡No te asustes! D= Te explicaremos, esta sección esta dividida en 2 tablas:
            </p>
            <p>
              <b>Alumnos que irán a la OMI <?php echo $dato["Lugar"]; ?>:</b> Aquí están los alumnos que se irán a la OMI con sede en <?php echo $dato["Lugar"]; ?>, pero ¡Tranquilo!, esta tabla se actualiza constantemente, no solo por que veas que ya hay nombres en la tabla no significa que ya no quedaste, ¡Al contrario!, debes esforzarte más si quieres ver tu nombre en esta tabla, ¿Cómo funciona la tabla?, esta tabla está ordenada según la puntuación de cada alumno, eso significa que si tu superas la puntuación de uno de esos alumnos tu nombre aparecerá ahí de inmediato =D! (Con inmediato nos referimos a cuando a uno de los asesores se les ocurra actualizar tu puntaje), esta tabla solo indica de los alumnos a nivel OEI, es decir, en la Escuela Miguel Hidalgo, de ustedes dependerá de ganar la fase estatal.
            </p>
            <p>
              <b>Ranking de Alumnos de la OEI:</b> Aquí es en donde aparecen todos los alumnos inscritos en la <b>Olimpiada Escolar de Informática (OEI)</b>, esta tabla funciona igual que la primera y se actualiza constantemente.
            </p>
            <h3>¡Mucha Suerte!</h3>
          </div>
          <br>
          <?php
          function incluir(){
          include("overall/Alumnos.php");
          }
          incluir();
          /*if (isset($_POST["element"])) {
            $element = $_POST["element"];
            require("php/includes/db.php");
            $db = new Conexion();
            $datos = $db->query("SELECT Score FROM usuarios WHERE Usuario='$element';");
            $dato = $db->recorrer($datos);
            $val = $dato["Score"];
            var_dump($val);
            $val2 = $val;
            while ($val == $val2) {
              usleep(2000000);
          		clearstatcache();
              $datos = $db->query("SELECT Score FROM usuarios WHERE Usuario='$element';");
              $dato = $db->recorrer($datos);
              $val = $dato["Score"];
              var_dump($val);
            }
            echo "w";
            echo "<script type='text/javascript' id='scr'>
            alert('Ha entrado');
              $(#rank).remove();
              $(#scr).remove();
            </script>";
            unset($_POST["element"]);
            incluir();
          }*/
          //
           ?>
        </div>
        <div class="col-md-1"></div>
      </section>
    </section>
    <footer>
      <?php
      if(isset($_SESSION["rol"])){
        if($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor"){
          echo "<div class='Listo'>
            <button type='button' name='listo' id='Listo'>
              <span class='glyphicon glyphicon-ok'></span>
            </button>
          </div>";
        }
      }
      if(isset($_SESSION["usuario"])){ include("overall/notificaciones.php");
    }
      ?>
    </footer>
  </body>
</html>
