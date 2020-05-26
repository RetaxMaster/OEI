<div class="boton" id="botonNav">
  <button type="button">
    <span class="glyphicon glyphicon-menu-hamburger"></span>
  </button>
</div>
<nav id="d">
    <div id="nav">
      <ul>
        <div class="header-nav">
          <h2>OEI</h2>
          <div class="contenedor pull-right">
          <span class="glyphicon glyphicon-chevron-left"></span>
          </div>
        </div>
        <hr>
        <a href="./"><li class="element"><span class="icon-home"></span> Inicio</li></a>
        <a href="Problemas.php"><li class="element"><span class="glyphicon glyphicon-cog"></span> Problemas</li></a>
        <hr>
        <a href="Acerca.php"><li class="element"><span class="glyphicon glyphicon-file"></span> Acerca de la OEI</li></a>
        <a href="Reglamento.php"><li class="element"><span class="glyphicon glyphicon-align-justify"></span> Reglamento</li></a>
        <?php
        if(isset($_SESSION["usuario"])){
          echo "<a href='Ayuda.php'><li class='element'><span class='glyphicon glyphicon-question-sign'></span> Ayuda</li></a>";
        }
         ?>
        <a href="Ranking.php"><li class="element"><span class="glyphicon glyphicon-list"></span> Ranking Ex-OEI's</li></a>
        <a href="Alumnos.php"><li class="element"><span class="icon-users"></span> Alumnos Inscritos</li></a>
        <a href="Fotos.php"><li class="element"><span class="glyphicon glyphicon-picture"></span> Fotos</li></a>
        <a href="Comentarios.php"><li class="element"><span class="glyphicon glyphicon-list-alt"></span> Comentarios</li></a>
        <hr>
        <?php

        if(isset($_SESSION["usuario"])){
          echo "<a href='Configuracion.php'><li class='element'><span class='glyphicon glyphicon-wrench'></span> Configuración</li></a>
          <a href='./?salir=salir'><li id='logoutNav' class='element'><span class='glyphicon glyphicon-log-out'></span> Salir</li></a>";
        }
        else {
          echo "<a href='#'><li id='loginNav' class='element'><span class='glyphicon glyphicon-log-out'></span> Login</li></a>";
        }

         ?>

      </ul>
    </div>
</nav>
