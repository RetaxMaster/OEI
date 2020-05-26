<?php session_start(); require("php/includes/db.php"); include("overall/session.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("overall/header.php"); ?>
    <link rel="stylesheet" href="css/Acerca.css" type="text/css">
    <title>Acerca de la OEI - Olimpiada Escolar de Informática</title>
  </head>
  <body>
    <header>
      <?php include("overall/nav.php"); ?>
      <?php
if(!isset($_SESSION["usuario"])){
include("overall/loginRegister.php");
}
 ?>
    </header>
    <section class="container-fluid">
      <section class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 contenedores main">
          <h2>Reglamento de la Olimpiada Escolar de Informática (OEI)</h2>
          <div class="acerca">
              <ul class="miUl">
                <li>Los participantes deberán estar inscritos en la Escuela Miguel Hidalgo e ir por lo menos en 1 año de secundaria y 4to semestre de bachiller.</li>
                <li>Se dará de baja al tener más de 3 faltas sin justificar a los cursos o reuniones que se requieran.</li>
                <li>El entrenador del COEI se elegirá por los participantes (cada año se renovara y será quien viaje como entrenador para la OMI del siguiente año) </li><br>
                <li>Los competidores están obligados a:
                        <ul>
                          <li>Respetar y atender las indicaciones que les haga su Líder, asesor o miembros del COEI.</li>
                          <li>Presentarse puntualmente a todos los exámenes y capacitaciones correspondientes.</li>
                          <li>Proporcionar la documentación que se le solicite (en caso de ser seleccionado para participar en la OMI).</li>
                          <li>Mantener la disciplina y el buen comportamiento durante los días que dure la competencia.</li>
                        </ul>
                </li><br>
                <li>Los líderes y asesores de la COEI, están obligados a:
                        <ul>
                          <li>Asesorar y apoyar académicamente a los competidores.</li>
                          <li>Proporcionar la información que se les solicite.</li>
                          <li>Asesorar, impartir clases técnicas, realizar ejemplos y aplicaciones, contestar dudas que le hagan llegar directamente o por Internet los competidores a la OMI y apoyar académicamente al COEI cuando así se le requiera.</li>
                        </ul>
                </li><br>
                <li>Los organizadores del COMI, están obligados a:
                        <ul>
                          <li>Promover el concurso estatal, conseguir y gestionar los apoyos necesarios para asistir a las capacitaciones y cursos externos.</li>
                          <li>Asegurar que esté disponible la infraestructura de cómputo, redes y laboratorios suficiente para el correcto desarrollo de las asesorías y capacitaciones.</li>
                          <li>Proporcionar al inicio de los cursos el temario con el que se abordaran </li>
                          <li>Publicar cualquier información de interés para los asistentes al evento.</li>
                          <li>Asesorar y apoyar a los asistentes al evento.</li>
                        </ul>
                </li>
              </ul>
          </div>
          <a href="php/validacionesAjax.php?tipo=descargar&nombre=Reglamento.docx&destino=Reglamento.php">
          <div class="descarga">
            <div class="col-md-2"></div>
            <div class="col-md-8 enlace contenedores">
              <p>También puedes descargar este documento haciendo click aquí.</p>
            </div>
            <div class="col-md-2"></div>
          </div></a>
        </div>
        <div class="col-md-2"></div>
      </section>
    </section>
    <footer>
      <?php
      if(isset($_SESSION["usuario"])){ include("overall/notificaciones.php");
    }
      ?>
    </footer>
  </body>
</html>
