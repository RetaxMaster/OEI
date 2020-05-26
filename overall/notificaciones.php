<?php

if (isset($_SESSION["usuario"])) {
  $db = new Conexion();
  $usuario = $_SESSION["usuario"];
  $datos = $db->query("SELECT * FROM notificaciones WHERE Destinatario='$usuario';");
    echo "<div class='Notificaciones'>";
  if ($db->filas($datos) > 0) {
    while ($dato = $db->recorrer($datos)) {
      if ($dato["Visto"] != 1) {
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
      echo "<a href='Comentarios.php' class='hrefNotf' id='$id'><div class='notificacion'>
        <span class='glyphicon glyphicon-remove pull-right'></span>
        <h4>¡Toc, Toc! Has recibido una nueva notificación.</h4><br>
        <p>$Remitente $Asunto.</p>
      </div></a>
      <script type='text/javascript' class='AudioNotf'>
      $(document).on('ready', function(){
      $('#AudioNotificacion').get(0).play();
      setTimeout(function(){ $('#AudioNotificacion').get(0).load(); $('.AudioNotf').remove();}, 1250);
      });
      </script>
      ";
      }
    }
  }
      echo "<audio id='AudioNotificacion' src='http://sandi7.net/repository/SaN666JV/4campanitas.mp3'></audio>";
    echo "</div>";
}

 ?>
