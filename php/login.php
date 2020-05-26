<?php
session_start();

require("includes/db.php");

if (isset($_GET["modo"])) {
  $modo = $_GET["modo"];
  switch ($modo) {
    case 'login':
      if(isset($_POST["nombre"]) and isset($_POST["contraseña"])){
        $usuario = $_POST["nombre"];
        $contraseña = $_POST["contraseña"];
        $db = new Conexion();
        $datos = $db->query("SELECT Rol FROM usuarios WHERE Usuario='$usuario';");
        $dato = $db->recorrer($datos);
        $Rol = $dato["Rol"];
        if (isset($_POST["recordar"])) {
        $recordar = $_POST["recordar"];
        if ($recordar == 1) {
          setcookie("usuario", $usuario, time() + 60 * 60 *24 * 365, "/");
          setcookie("rol", $Rol, time() + 60 * 60 *24 * 365, "/");
        }
        }
        if (!empty($usuario) and !empty($contraseña)) {
          $_SESSION["usuario"] = $usuario;
          $_SESSION["rol"] = $Rol;
          header("location: .././");
        }
        else {
          header("location: .././");
        }
      }
      else {
        header("location: .././");
      }
      break;

    case 'register':
    if (isset($_POST["email"]) and isset($_POST["Regnombre"]) and isset($_POST["Regcontraseña"]) and isset($_POST["fecha"]) and isset($_POST["sexo"]) and isset($_POST["especialidad"]) and isset($_POST["sem"]) and isset($_POST["Omegaup"]) and isset($_POST["Nombres"]) and isset($_POST["Apellidos"])) {
      $email = filter_var(stripslashes(htmlspecialchars(trim($_POST["email"]))), FILTER_SANITIZE_STRING);
      $nombre = filter_var(stripslashes(htmlspecialchars(trim($_POST["Regnombre"]))), FILTER_SANITIZE_STRING);
      $contraseña = filter_var(stripslashes(htmlspecialchars(trim($_POST["Regcontraseña"]))), FILTER_SANITIZE_STRING);
      $fecha = filter_var(stripslashes(htmlspecialchars(trim($_POST["fecha"]))), FILTER_SANITIZE_STRING);
      $sexo = filter_var(stripslashes(htmlspecialchars(trim($_POST["sexo"]))), FILTER_SANITIZE_STRING);
      $especialidad = filter_var(stripslashes(htmlspecialchars(trim($_POST["especialidad"]))), FILTER_SANITIZE_STRING);
      $semestre = filter_var(stripslashes(htmlspecialchars(trim($_POST["sem"]))), FILTER_SANITIZE_STRING);
      $OmegaUp = filter_var(stripslashes(htmlspecialchars(trim($_POST["Omegaup"]))), FILTER_SANITIZE_STRING);
      $Nombres = filter_var(stripslashes(htmlspecialchars(trim($_POST["Nombres"]))), FILTER_SANITIZE_STRING);
      $apellido = filter_var(stripslashes(htmlspecialchars(trim($_POST["Apellidos"]))), FILTER_SANITIZE_STRING);

      if (!empty($email) and !empty($nombre) and !empty($contraseña) and !empty($fecha) and !empty($sexo) and !empty($especialidad) and !empty($semestre) and !empty($OmegaUp) and !empty($Nombres) and !empty($apellido)) {
      $actua = "NoActualizada-Actualizado-Actualizado";
      $fechas = explode("-", $fecha);
      $edad = date("Y") - $fechas[0];
      $edad--;
      if (date("m") >= $fechas[1]) {
        if(date("m") > $fechas[1]){
          $edad++;
          $actua = "Actualizada-Actualizado-Actualizado";
        }
        else if (date("d") >= $fechas[2]) {
          $edad++;
          $actua = "Actualizada-Actualizado-Actualizado";
        }
      }
      $db = new Conexion();
      $db->query("INSERT INTO usuarios (Nombre, Apellido, Usuario, Correo, Contraseña, Cumpleaños, Edad, Sexo, Especialidad, Semestre, OmegaUp, Score, Rol, FechaActualizada, Foto) VALUES ('$Nombres', '$apellido', '$nombre', '$email', '$contraseña', '$fecha', '$edad', '$sexo', '$especialidad', '$semestre', '$OmegaUp', '0', 'Invitado', '$actua', 'Default.jpg');");
      $_SESSION["usuario"] = $nombre;
      $_SESSION["rol"] = "Invitado";
        header("location: .././");
      }
    }
    else {
      header("location: .././");
    }
      break;

    default:
      header("location: .././");
      break;
  }
}
else {
  header("location: .././");
}

 ?>
