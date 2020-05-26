<?php
session_start();
date_default_timezone_set("America/Monterrey");
set_time_limit(0);
require("includes/generar.php");

if (isset($_GET["tipo"]) || isset($_POST["tipo"])) {
  if (isset($_GET["tipo"])) {
  $tipo = $_GET["tipo"];
  }
  else {
    $tipo = $_POST["tipo"];
  }
  require("includes/db.php");
  $db = new Conexion();

  switch ($tipo) {
    case 'registro':
      $db = new Conexion();
      $username = $_GET["username"];
      $email = $_GET["email"];
      $OmegaUp = $_GET["Omegaup"];
      $datos = $db->query("SELECT Usuario,Correo,OmegaUp FROM usuarios WHERE Usuario='$username' OR Correo='$email' OR OmegaUp='$OmegaUp';");
      $dato = $db->recorrer($datos);
      $dbUsername = $dato["Usuario"];
      $dbEmail = $dato["Correo"];
      $dbOmegaUp = $dato["OmegaUp"];

      if (strtolower($username) == strtolower($dbUsername)) {
        $ar["Usuario"] = "Verdadero";
      }
      else {
        $ar["Usuario"] = "Falso";
      }

      if (strtolower($email) == strtolower($dbEmail)) {
        $ar["Email"] = "Verdadero";
      }
      else {
        $ar["Email"] = "Falso";
      }

      if (strtolower($OmegaUp) == strtolower($dbOmegaUp)) {
        $ar["OmegaUp"] = "Verdadero";
      }
      else {
        $ar["OmegaUp"] = "Falso";
      }

      $DatosJson = json_encode($ar);
      echo $DatosJson;

      break;

    case 'ObtenerHora':
    $fecha = date("d")."/".date("m")."/".date("Y")." ".date("h").":".date("i")." ".date("a");
    echo $fecha;
    break;

    case 'nuevoAsesor':
    $nuevoAsesor = $_GET["asesor"];
    $db = new Conexion();
    $datos = $db->query("SELECT Usuario,Rol FROM usuarios WHERE Usuario='$nuevoAsesor';");
    $dato = $db->recorrer($datos);

    if ($dato["Usuario"] == $nuevoAsesor) {
      if ($dato["Rol"] != "Administrador") {
          $db->query("UPDATE usuarios SET Rol='Asesor' WHERE Usuario='$nuevoAsesor';");
          $db->query("UPDATE comentarios SET Rol='Asesor' WHERE Usuario='$nuevoAsesor';");
          echo "Exito";
      }
      else {
        echo "Este usuario es un administrador";
      }
    }
    else {
    echo "Usuario no registrado";
    }
    break;

    case 'Login':
    $user = $_GET["user"];
    $pass = $_GET["pass"];
    $db = new Conexion();
    $datos = $db->query("SELECT Usuario,Contraseña FROM usuarios WHERE Usuario='$user' AND Contraseña='$pass';");
    $dato = $db->recorrer($datos);

    if ($dato["Usuario"] == $user and $dato["Contraseña"] == $pass) {
      echo "Correcto";
    }
    else {
      echo "Incorrecto";
    }
    break;

    case 'Ayuda':
    $Nombre = $_GET["Nombre"];
    $Contenido = $_GET["Contenido"];
    $url = $_GET["url"];
    $Dependencia = $_GET["Dependencia"];
    $db = new Conexion();
    $db->query("INSERT INTO ayuda (Nombre,Contenido,url,Dependencia) VALUES ('$Nombre', '$Contenido', '$url', '$Dependencia');");
    echo "Exito";
    break;

    case 'Configuracion':
    $usuario = $_GET["sesion"];
    $db = new Conexion();
    $datos = $db->query("SELECT * FROM usuarios WHERE Usuario='$usuario';");
    $dato = $db->recorrer($datos);
    $ar["Nombre"] = $dato["Nombre"];
    $ar["Apellido"] = $dato["Apellido"];
    $ar["Cumpleaños"] = $dato["Cumpleaños"];
    $ar["Sexo"] = $dato["Sexo"];
    $ar["Especialidad"] = $dato["Especialidad"];
    $ar["Semestre"] = $dato["Semestre"];
    $ar["OmegaUp"] = $dato["OmegaUp"];
    $ar["Score"] = $dato["Score"];
    $ar["Edad"] = $dato["Edad"];
    $ar["Dependencia"] = $dato["Rol"];
    $ar["Foto"] = $dato["Foto"];
    $ar["Usuario"] = $dato["Usuario"];
    $ar["UsuarioActual"] = $_SESSION["usuario"];

    $DatosJson = json_encode($ar);
    echo $DatosJson;
    break;


    case 'checarExistencia':
    $datoAenc = $_GET["usuario"];
    $campo = $_GET["campo"];
    $tabla = $_GET["tabla"];
    $db = new Conexion();
    $datos = $db->query("SELECT $campo FROM $tabla WHERE $campo='$datoAenc';");
    $dato = $db->recorrer($datos);
    echo $dato[$campo];
    break;

    case 'cambiarC':
    $nc = $_GET["nc"];
    $user = $_GET["user"];
    $db = new Conexion();
    $db->query("UPDATE usuarios SET Contraseña='$nc' WHERE Usuario='$user';");
    echo "Exito";
    break;

    case 'actualizarRankAlumnos':
    $usuario = $_GET["usuario"];
    $punt = $_GET["valor"];
    $db = new Conexion();
    $db->query("UPDATE usuarios SET Score='$punt' WHERE Usuario='$usuario';");
    echo "Exito";
    break;

    case 'NuevoExoei':
    $Nombre = $_GET["Nombre"];
    $Semestre = $_GET["Semestre"];
    $Lugar = $_GET["Lugar"];
    $Posicion = $_GET["Posicion"];
    $Anio = $_GET["Anio"];
    $Puntaje = $_GET["Puntaje"];
    $db = new Conexion();
    $db->query("INSERT INTO ranking (ExOEI,Semestre,Lugar,Posicion,Año,Puntaje) VALUES ('$Nombre', '$Semestre', '$Lugar', '$Posicion', '$Anio', '$Puntaje');");
    echo "Exito";
    break;

    case 'nuevoProblema':
    $Nombre = $_GET["Nombre"];
    $Lenguajes = $_GET["Lenguajes"];
    $url = $_GET["url"];
    $descripcion = $_GET["descripcion"];
    $db = new Conexion();
    $db->query("INSERT INTO problemas (Descripcion,Lenguajes,Nombre,url) VALUES ('$descripcion', '$Lenguajes', '$Nombre', '$url');");
    echo "Exito";
    break;

    case 'nuevaPub':
    $pub = $_GET["pub"];
    $fecha = $_GET["fecha"];
    $Imagen = $_GET["img"];
    $db = new Conexion();
    $db->query("INSERT INTO publicaciones (Fecha,Publicacion, Imagen) VALUES ('$fecha', '$pub', '$Imagen');");
    echo "Exito";
    break;

    case 'delAsesor':
    $user = $_GET["user"];
    $db = new Conexion();
    $datos = $db->query("SELECT Usuario,Rol FROM usuarios WHERE Usuario='$user';");
    $dato = $db->recorrer($datos);

    if ($dato["Usuario"] == $user) {
      if ($dato["Rol"] == "Asesor") {
        $db->query("UPDATE usuarios SET Rol='Invitado' WHERE Usuario='$user';");
        $db->query("UPDATE comentarios SET Rol='Invitado' WHERE Usuario='$user';");
        echo "Exito";
      }
      else {
        echo "Este usuario no es Asesor";
      }
    }
    else {
    echo "Usuario no registrado";
    }
    break;

    case 'eliminar':
    $id = $_GET["id"];
    $tabla = $_GET["tabla"];
    $db = new Conexion();
    $datos = $db->query("DELETE FROM $tabla WHERE id = $id;");
    echo "Exito";
    break;

    case 'ObtenerElemento':
    $campoASeleccionar = $_GET["campoASeleccionar"];
    $tabla = $_GET["tabla"];
    $db = new Conexion();
    $datos = $db->query("SELECT $campoASeleccionar FROM $tabla ORDER BY id DESC LIMIT 1;");
    $dato = $db->recorrer($datos);
    $ar["campo"] = $dato["$campoASeleccionar"];
    $ar["Exito"] = "Exito";
    $DatosJson = json_encode($ar);
    echo $DatosJson;
    break;

    case 'sede':
    $lugar = $_GET["lugar"];
    $año = date("Y") + 1;
    $db = new Conexion();
    $db->query("INSERT INTO sedes (Lugar,Año) VALUES ('$lugar', '$año');");
    break;

    case 'NuevoComent':
    $coment = $_GET["com"];
    $usuario = $_SESSION["usuario"];
    $Rol = $_SESSION["rol"];
    if (isset($_GET["img"])) {
    $Img = $_GET["img"];
    }
    else {
      $Img = "";
    }
    $etiquetas = $_GET["etiquetas"];
    $fecha = date("d")."/".date("m")."/".date("Y")." ".date("h").":".date("i")." ".date("a");;
    $db = new Conexion();
    $db->query("INSERT INTO comentarios (Usuario,Fecha,Comentario,Rol,Imagen) VALUES ('$usuario','$fecha','$coment','$Rol','$Img');");
    if (!empty($etiquetas)) {
      $usuariosExistentes = "";
      $etiqueta = array_unique(explode(".",$etiquetas));
      for ($i=0; $i < count($etiqueta); $i++) {
        $key = key($etiqueta);
        $datos = $db->query("SELECT Usuario FROM usuarios WHERE Usuario='$etiqueta[$key]';");
        if ($db->filas($datos) > 0) {
          $usuariosExistentes .= $etiqueta[$key].".";
          $db->query("INSERT INTO notificaciones (Asunto,Destinatario,Remitente,Visto) VALUES ('Comentario','$etiqueta[$key]','$usuario','0');");
        }
        next($etiqueta);
      }
      $ar["exists"] = $usuariosExistentes;
    }
      $ar["etasd"] = $etiquetas;
    $ar["Exito"] = "Exito";
    $DatosJson = json_encode($ar);
    echo $DatosJson;
    break;

    case 'ObtenerUsuarioRol':
    $ar["user"] = $_SESSION["usuario"];
    $ar["rol"] = $_SESSION["rol"];
    $ar["Exito"] = "Exito";
    $DatosJson = json_encode($ar);
    echo $DatosJson;
    break;

    case 'comprobarImagenYSubir':
    if (!empty($_FILES["file"]["name"])) {
    $check = @getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
      $Generar = new Generar();
      $codigo = $Generar->GenerarP(20);
      $extension = explode(".", $_FILES["file"]["name"])[1];
      $_FILES["file"]["name"] = $codigo.".".$extension;
      $foto = $_FILES["file"]["name"];
      $archivoASubir = "../images/$foto";
      move_uploaded_file($_FILES["file"]["tmp_name"], $archivoASubir);
      $exito = $foto;
    }
    else {
      $exito = "Esta no es una imagen";
    }
    }
    else {
      $exito = "";
    }
    echo $exito;

    break;

    case 'EliminarImagen':
    $nombreImg = $_GET["nombre"];
    if ($nombreImg != "Default.jpg") {
    unlink("../images/$nombreImg");
    }
    break;

    case 'descargar':
    $archivo = basename($_GET["nombre"]);
    $destino = $_GET["destino"];

    $ruta = "../docs/".$archivo;

    if (is_file($ruta))
    {
       header("Content-Type: application/force-download");
       header("Content-Disposition: attachment; filename=".$archivo);
       header("Content-Transfer-Encoding: binary");
       header("Content-Length: ".filesize($ruta));
       readfile($ruta);
       header("location: $destino");
    }
    break;

    case 'AgregarFotoDePerfilALaBaseDeDatos':
    $img = $_GET["url"];
    $usuario = $_SESSION["usuario"];
    $db= new Conexion();
    $db->query("UPDATE usuarios SET Foto='$img' WHERE Usuario='$usuario';");
    break;

    case 'ObtenerFotoDePerfil':
    $db = new Conexion();
    $usuario = $_SESSION["usuario"];
    $datos = $db->query("SELECT Foto FROM usuarios WHERE Usuario='$usuario';");
    $dato = $db->recorrer($datos);
    echo "Exito&".$dato["Foto"];
    break;

    case 'EliminarNotificacion':
      $db = new Conexion();
      $id = $_GET["id"];
      $db->query("DELETE FROM notificaciones WHERE id='$id';");
      echo "Exito";
    break;

    case 'BuscadorSugerencia':
    function Buscar($a){
      $db = new Conexion();
      $user = $a;
      $datos = $db->query("SELECT Usuario FROM usuarios WHERE Usuario LIKE '%$user%';");
      while ($dato = $db->recorrer($datos)) {
        $arreglo[] = $dato["Usuario"];
      }
      return $arreglo;
    }
    echo json_encode(Buscar($_GET["term"]));
    break;

    case 'Alumno':
    $db = new Conexion();
    $usuario = $_GET["usuario"];
    $accion = $_GET["accion"];
    $datos = $db->query("SELECT Usuario,Rol FROM usuarios WHERE Usuario = '$usuario';");
    $dato = $db->recorrer($datos);
    if ($db->filas($datos) > 0) {
    if ($accion == "Eliminar") {
      if ($dato["Rol"] == "Alumno") {
        $db->query("UPDATE usuarios SET Rol='Invitado' WHERE Usuario = '$usuario';");
        $db->query("UPDATE comentarios SET Rol='Invitado' WHERE Usuario = '$usuario';");
        $x = "Exito";
      }
      else {
        $x = "Este usuario no es un alumno";
      }
    }
    else if ($accion == "Agregar"){
      if ($dato["Rol"] != "Administrador" && $dato["Rol"] != "Asesor") {
        $datas = $db->query("SELECT Sexo FROM Usuarios WHERE Usuario = '$usuario';");
        $data = $db->recorrer($datas);
        $db->query("UPDATE usuarios SET Rol='Alumno' WHERE Usuario = '$usuario';");
        $db->query("UPDATE comentarios SET Rol='Alumno' WHERE Usuario = '$usuario';");

        $x = "Exito";
      }
      else {
        if ($dato["Rol"] == "Administrador"){
          $x = "Este usuario es un Administrador";
        }
        if ($dato["Rol"] == "Asesor"){
          $x = "Este usuario es un Asesor";
        }
      }
    }
    }
    else {
      $x = "El usuario no existe";
    }
    echo $x;
    break;

    case 'PaginacionComents':
    $paginacion = $_GET["Paginacion"];
    $nuevaPag = $paginacion + 10;
    $db = new Conexion();
    $datos = $db->query("SELECT * FROM comentarios ORDER BY id DESC LIMIT $paginacion, 10;");
    if ($db->filas($datos) > 0) {
    $c=0;
    while ($dato = $db->recorrer($datos)) {
      $arId[$c] = $dato["id"];
      $arFecha[$c] = $dato["Fecha"];
      $arRol[$c] = $dato["Rol"];
      $arUsuario[$c] = $dato["Usuario"];
      $arComent[$c] = $dato["Comentario"];
      $arImagen[$c] = $dato["Imagen"];
      //

      $Usuario = $dato["Usuario"];

      $datos2 = $db->query("SELECT Foto FROM usuarios WHERE usuario='$Usuario';");
      $dato2 = $db->recorrer($datos2);
      $arImg[$c] = $dato2["Foto"];
      //
      $c++;
    }

    if (isset($_SESSION["usuario"])) {
      $ar["RolAct"] = $_SESSION["rol"];
      $ar["usuarioAct"] = $_SESSION["usuario"];
    }
    else {
      $ar["RolAct"] = "Invitado";
      $ar["usuarioAct"] = "Anónimo";
    }


    $ar["idd"] = $arId;
    $ar["Fecha"] = $arFecha;
    $ar["Rol"] = $arRol;
    $ar["Usuario"] = $arUsuario;
    $ar["contenido"] = $arComent;
    $ar["Imagen"] = $arImagen;
    $ar["Img"] = $arImg;
    $ar["Pag"] = $nuevaPag;
    $ar["Exito"] = "Exito";
    }
    else {
      $ar["Exito"] = "No";
    }
    $data = json_encode($ar);
    echo $data;
    break;

    case 'Paginacion':
    $paginacion = $_GET["Paginacion"];
    $nuevaPag = $paginacion + 10;
    $db = new Conexion();
    $datos = $db->query("SELECT * FROM publicaciones ORDER BY id DESC LIMIT $paginacion, 10;");
    if ($db->filas($datos) > 0) {
    $c=0;
    while ($dato = $db->recorrer($datos)) {
      $arPubs[$c] = $dato["Publicacion"];
      $arImg[$c] = $dato["Imagen"];
      $arId[$c] = $dato["id"];
      $arFecha[$c] = $dato["Fecha"];
      $c++;
    }
    $ar["Publicacion"] = $arPubs;
    $ar["Imagen"] = $arImg;
    $ar["idd"] = $arId;
    $ar["Fecha"] = $arFecha;
    $ar["Pag"] = $nuevaPag;
    $ar["Exito"] = "Exito";
    }
    else {
      $ar["Exito"] = "No";
    }
    $data = json_encode($ar);
    echo $data;
    break;

    case 'visto':
    $id = $_GET["id"];
    $db->query("UPDATE notificaciones SET Visto = '1' WHERE id = $id;");
    break;

    default:
      header("location: .././");
  }
}
else {
  header("location: .././");
}

 ?>
