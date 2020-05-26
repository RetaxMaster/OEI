  <script type="text/javascript">
    location.href = ".././";
  </script>
<div class="Ranking" id="Ranking">
  <h2>Ranking:</h2>
  <br>
  <div class="col-md-1"></div>
  <table class="col-xs-12 col-md-10">
    <tr>
      <td>
        <b>Lugar</b>
      </td>
      <td>
        <b>Ex-OEI</b>
      </td>
      <td>
        <b>Semestre en que ganó</b>
      </td>
      <td>
        <b>Lugar de la sede</b>
      </td>
      <td>
        <b>Posición obtenida en la OMI</b>
      </td>
      <td>
        <b>Año</b>
      </td>
      <td>
        <b>Puntaje</b>
      </td>
    </tr>
    <?php

    require("../php/includes/db.php");
    $db = new Conexion();
    $datos = $db->query("SELECT * FROM ranking ORDER BY Puntaje DESC;");
    if ($db->filas($datos) > 0) {
      $lugar = 0;
      while ($campos = $db->recorrer($datos)) {
        $Nombre = $campos["ExOEI"];
        $Semestre = $campos["Semestre"];
        $Lugar = $campos["Lugar"];
        $Posicion = $campos["Posicion"];
        $Año = $campos["Año"];
        $Score = $campos["Puntaje"];
      echo "<tr>
        <td>
          ".++$lugar."°
        </td>
        <td>
          $Nombre
        </td>
        <td>
          $Semestre
        </td>
        <td>
          $Lugar
        </td>
        <td>
          $Posicion
        </td>
        <td>
          $Año
        </td>
        <td>
          $Score
        </td>
      </tr>";
    }
  }

     ?>

  </table>
  <div class="col-md-1"></div>
</div>
