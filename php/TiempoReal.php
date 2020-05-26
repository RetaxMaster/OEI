<?php
include("includes/db.php");
set_time_limit(0);

$db = new Conexion();

if (isset($_GET["modo"])) {
  $modo = $_GET["modo"];
  switch ($modo) {

    case 'treal':
    $nRows1 = 0;
    $datos = $db->query("SELECT * FROM comentarios");
    $nRows2 = $db->filas($datos);
    while ($nRows2 >= $nRows1) {
      $datos = $db->query("SELECT * FROM comentarios");
      $nRows1 = $db->filas($datos);
      if ($nRows1 + 1 <= $nRows2) {
        $datos = $db->query("SELECT * FROM comentarios");
        $nRows2 = $db->filas($datos);
        $nRows1 = $db->filas($datos);
      }
      usleep(100000);
      clearstatcache();
    }
    $datos2 = $db->query("SELECT * FROM comentarios ORDER BY id DESC LIMIT 1;");
    while ($row = $db->recorrer($datos2)) {
      $ar["idd"] = $row["id"];
      $ar["Fecha"] = $row["Fecha"];
      $ar["Rol"] = $row["Rol"];
      $ar["Usuario"] = $row["Usuario"];
      $ar["contenido"] = $row["Comentario"];
      $ar["Imagen"] = $row["Imagen"];

      $Usuario = $row["Usuario"];

      $datos2 = $db->query("SELECT Foto FROM usuarios WHERE usuario='$Usuario';");
      $dato2 = $db->recorrer($datos2);
      $ar["Img"] = $dato2["Foto"];
    }
    session_start();
    if (isset($_SESSION["usuario"])) {
      $ar["RolAct"] = $_SESSION["rol"];
      $ar["usuarioAct"] = $_SESSION["usuario"];
    }
    else {
      $ar["RolAct"] = "Invitado";
      $ar["usuarioAct"] = "Anónimo";
    }
    $DatosJson = json_encode($ar);
    echo $DatosJson;
    break;

    case 'Notificaciones':
      $usuario = $_GET["usuario"];
      $nRows1 = 0;
      $datos = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
      $nRows2 = $db->filas($datos);
      while ($nRows2 >= $nRows1) {
        $datos = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
        $nRows1 = $db->filas($datos);
        if ($nRows1 + 1 <= $nRows2) {
          $datos = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
          $nRows2 = $db->filas($datos);
          $nRows1 = $db->filas($datos);
        }
        usleep(100000);
        clearstatcache();
      }
      $datos2 = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
      while ($row = $db->recorrer($datos2)) {
        $Rem = $row["Remitente"];
        $datos2 = $db->query("SELECT Rol FROM usuarios WHERE Usuario='$Rem';");
        $dato = $db->recorrer($datos2);
        $ar["Asunto"] = $row["Asunto"];
        $ar["Destinatario"] = $row["Destinatario"];
        $ar["Remitente"] = $row["Remitente"];
        $ar["idObt"] = $row["id"];
        $ar["Rol"] = $dato["Rol"];
      }
      $DatosJson = json_encode($ar);
      echo $DatosJson;
      break;

      case 'Publicaciones':
      $nRows1 = 0;
      $datos = $db->query("SELECT * FROM publicaciones");
      $nRows2 = $db->filas($datos);
      while ($nRows2 >= $nRows1) {
        $datos = $db->query("SELECT * FROM publicaciones");
        $nRows1 = $db->filas($datos);
        if ($nRows1 + 1 <= $nRows2) {
          $datos = $db->query("SELECT * FROM publicaciones");
          $nRows2 = $db->filas($datos);
          $nRows1 = $db->filas($datos);
        }
        usleep(100000);
        clearstatcache();
      }
      $datos2 = $db->query("SELECT * FROM publicaciones ORDER BY id DESC LIMIT 1;");
      while ($row = $db->recorrer($datos2)) {
        $ar["idd"] = $row["id"];
        $ar["Fecha"] = $row["Fecha"];
        $ar["Publicacion"] = $row["Publicacion"];
        $ar["Imagen"] = $row["Imagen"];
      }
      $DatosJson = json_encode($ar);
      echo $DatosJson;
      break;
  }
}

 ?>
