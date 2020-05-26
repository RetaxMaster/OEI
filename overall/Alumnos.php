<div class="Ranking" id="rank">
  <h2>Alumnos de la OEI:</h2>
  <br>
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="OMI">
      <h4><b>Alumnos que irán a la OMI <?php
      $db = new Conexion();
      $datos = $db->query("SELECT Lugar FROM sedes ORDER BY id DESC LIMIT 1");
      $dato = $db->recorrer($datos);
       echo $dato["Lugar"]; ?>:</b></h4>
      <table class="table-responsives">
        <tr>
          <td>
            <b>Lugar</b>
          </td>
          <td>
            <b>Nombre</b>
          </td>
          <td>
            <b>Nombre de usuario</b>
          </td>
          <td>
            <b>Puntaje</b>
          </td>
        </tr>
        <?php
        $db = new Conexion();
        $datos = $db->query("SELECT Nombre, Usuario, Score, Rol FROM usuarios WHERE Rol='Alumno' ORDER BY Score DESC");
        if($db->filas($datos) > 0){
        $c=0;
        while ($c < 3) {
          $campo = $db->recorrer($datos);
          $c++;
          $Nombre = $campo["Nombre"];
          $Usuario = $campo["Usuario"];
          $Score = $campo["Score"];
          echo "<tr>
            <td>
              ".$c."°
            </td>
            <td class='Nombre'>
              $Nombre
            </td>
            <td class='username'>
              <p>$Usuario</p>
            </td>
            <td>";
            if (isset($_SESSION["rol"])) {
              if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
                echo "<span class='Puntuacion claseAdmin'>$Score</span>
                </td>
              </tr>";
              }
              else {
                echo "$Score
                </td>
              </tr>";
              }
            }
            else {
              echo "$Score
              </td>
            </tr>";
            }
        }
      }

         ?>
      </table>
    </div>
    <br><br>
    <div class="OEI">
      <h4><b>Ranking de Alumnos de la OEI:</b></h4>
  <table>
    <tr>
      <td>
        <b>Lugar</b>
      </td>
      <td>
        <b>Nombre</b>
      </td>
      <td>
        <b>Nombre de usuario</b>
      </td>
      <td>
        <b>Puntaje</b>
      </td>
    </tr>
    <?php
    $db = new Conexion();
    $datos = $db->query("SELECT Nombre, Usuario, Score, Rol FROM usuarios WHERE Rol='Alumno' ORDER BY Score DESC");
    if ($db->filas($datos) > 0) {
    $c=0;
    while ($campo = $db->recorrer($datos)) {
      $c++;
      if($c >= 4){
      $Nombre = $campo["Nombre"];
      $Usuario = $campo["Usuario"];
      $Score = $campo["Score"];
      echo "<tr>
        <td>
          ".$c."°
        </td>
        <td class='Nombre'>
          $Nombre
        </td>
        <td class='username'>
          <p>$Usuario</p>
        </td>
        <td>";
        if (isset($_SESSION["rol"])) {
          if ($_SESSION["rol"] == "Administrador" or $_SESSION["rol"] == "Asesor") {
            echo "<span class='Puntuacion claseAdmin'>$Score</span>
            </td>
          </tr>";
          }
          else {
            echo "$Score
            </td>
          </tr>";
          }
        }
        else {
          echo "$Score
          </td>
        </tr>";
        }
      }
    }
  }

     ?>
  </table>
    </div>
  </div>
  <div class="col-md-1"></div>
</div>
