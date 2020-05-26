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
          <h2>Acerca de la Olimpiada Escolar de Informática</h2>
          <div class="acerca">
            <h3><b>¿Qué es la OEI?</b></h3>
            <p>
              La <b>Olimpiada Escolar de Informática (OEI)</b> es un concurso a nivel escolar para jóvenes con facilidad para resolver problemas prácticos mediante la lógica y el uso de computadoras, que busca promover el desarrollo tecnológico en el municipio y encontrar a los mejores programadores, quienes formarán la delegación para competir en las olimpiadas nacionales de la <b>Olimpiada Mexicana de Informática (OMI)</b>.
            </p>
              <h3><b>Requisitos</b></h3>
              <p>
                Pueden participar todos aquellos jóvenes que cumplan con los siguientes requisitos:
              </p>
              <ul class="miUl">
                <li>Ser Mexicano (Requisito OMI)</li>
                <li>Ser alumno de secundaria 1°, 2° o 3°</li>
                <li>Estar inscrito en cualquier especialidad de la escuela en 2° año de preparatoria o equivalente como límite de escolaridad. </li>
              </ul>

              <p>
                Los conocimientos y habilidades mínimas con las que deberán contar son las siguientes:
              </p>

              <ul class="miUl">
                <li>Matemáticas básicas: Aritmética, Álgebra y Trigonometría</li>
                <li>Gusto y placer por resolver problemas y retos.</li>
              </ul>
              <p>
                Temario C++
              </p>
              <ul class="miUl">
                <li>Estructuras de Datos</li>
                <li>Programación Dinámica</li>
                <li>Búsquedas</li>
                <li>Grafos</li>
                <li>Algoritmos Diversos</li>
              </ul>
              <h3><b>Origen de la OEI</b></h3>
              <p>
                Se origina a través de la necesidad de estudiar diversos lenguajes de programación lógico matemático, así mismo ayuda a generar el interés por estas áreas en los jóvenes y a desarrollar a aquellos que tienen las cualidades para sobresalir en ellas.
              </p>
              <h3><b>Importancia de la OEI</b></h3>
              <ul class="miUl">
                <li>El mundo que nos rodea está completamente computarizado, el software es la nueva herramienta del mundo.</li>
                <li>Las computadoras se han introducido en todas las acciones de nuestra vida diaria, desde nuestros automóviles, refrigeradores y medios de comunicación.</li>
                <li>Resulta inconcebible desarrollar nuestras actividades de trabajo o tarea, sin la ayuda de un procesador de texto o sin tener acceso a nuestro correo electrónico.</li>
              </ul>
              <h3><b>El COEI</b></h3>
              <p>
                El <b>Comité Escolar de Informática (COEI)</b> se encuentra conformado por líderes y asesores encargados de la organización de los concursos en base a la experiencia para competir en la OMI.
              </p>
              <br>
              <div class="profesiograma">
                <div class="col-md-1"></div>
                <div class="col-md-10" id="imagen">
                <img src="images/profesiograma.png" alt="Profesiograma" />
                </div>
                <div class="col-md-1"></div>
              </div>
              <br>
              <br>
              <h3><b>Desarrollo de la OEI</b></h3>
              <ol>
                <li>Inscripciones (Abril)</li>
                <li>Entrenamiento y exámenes nivel básico (Abril - Mayo - Junio - Julio)</li>
                <li>Entrenamiento y exámenes nivel intermedio  (Agosto – Septiembre - Octubre - Noviembre)</li>
                <li>Entrenamiento y exámenes nivel avanzado (Diciembre - Enero - Febrero - Marzo)</li>
                <li>Participación en el examen de matemáticas (Febrero)</li>
                <li>Participación en preselectivo estatal con las diferentes escuelas participantes (Marzo - Abril)</li>
                <li>Participación en el concurso Nacional - OMI (Mayo)</li>
              </ol>
          </div>
          <a href="php/validacionesAjax.php?tipo=descargar&nombre=Acerca.docx&destino=Acerca.php">
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
