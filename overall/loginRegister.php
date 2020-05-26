<!--  Ventana Modal  -->
<div class="vmodalL" id="LoginOrRegister">
  <div class="col-xs-1 col-sm-3 col-md-4"></div>
  <div class="contenido contenedores col-xs-10 col-sm-6 col-md-4">
    <span class="glyphicon glyphicon-remove pull-right" id="cerrarL"></span>
    <div class="mainL">
      <div class="LoginAndRegister">
        <div class="Login">
          <button type="button" name="Login" class="boton active" id="entrar">Entrar</button>
        </div>
        <div class="Register">
          <button type="button" name="Register" class="boton" id="registrarse">Registrarse</button>
        </div>
      </div>
      <br>
      <div class="formLogin">
        <form class="login" action="php/login.php?modo=login" method="post" id="Log">
          <label for="Nombre">Nombre de Usuario: </label><br>
          <input type="text" name="nombre" id="Nombre">
          <label for="password">Contraseña: </label><br>
          <input type="password" name="contraseña" id="password">
          <input type="checkbox" name="recordar" value="1" id="recordar"> <label for="recordar">Deseo recordar mis datos</label><br>
          <input type="submit" name="entrar" value="¡Entrar!">
        </form>
      </div>
      <div class="formRegister">
        <form class="regi" id="reg" action="php/login.php?modo=register" method="post">
          <div class="inputsText">
          <label for="Email">Correo Electrónico: </label><br>
          <input type="email" name="email" id="Email">
          <label for="Nombres">Nombre(s): </label><br>
          <input type="text" name="Nombres" id="Nombres">
          <label for="Apellidos">Apellido: </label><br>
          <input type="text" name="Apellidos" id="Apellidos">
          <label for="RegNombre">Nombre de Usuario: </label><br>
          <input type="text" name="Regnombre" id="RegNombre">
          <label for="Omegaup">Usuario de OmegaUp: </label><br>
          <input type="text" name="Omegaup" id="Omegaup">
          <label for="Regpassword">Contraseña: </label><br>
          <input type="password" name="Regcontraseña" id="Regpassword">
          <label for="rpassword">Repetir Contraseña: </label><br>
          <input type="password" name="rcontraseña" id="rpassword">
          <label for="fecha">Fecha de Nacimiento: </label><br>
          <input type="date" name="fecha" id="fecha" placeholder="Formato dd/mm/aaaa">
          </div>
          <div class="sexo">
            <h4>Sexo</h4>
            <div class="radios">
              <input type="radio" name="sexo" id="m" value="Masculino" class="inputError">
              <label for="m">Masculino </label>
            </div>
            <div class="radios">
              <input type="radio" name="sexo" id="f" value="Femenino">
              <label for="f">Femenino </label>
            </div>
            <div class="radios">
              <input type="radio" name="sexo" id="i" value="Indistinto">
              <label for="i">Indistinto </label>
            </div>
          </div>
          <div class="especialidad">
          <h4>Especialidad</h4>
          <div class="radios">
          <input type="radio" name="especialidad" id="p" value="Programador">
          <label for="p">Técnico Programador </label>
          </div>
          <div class="radios">
          <input type="radio" name="especialidad" id="diet" value="Dietista">
          <label for="diet">Dietista </label>
          </div>
          <div class="radios">
          <input type="radio" name="especialidad" id="ts" value="TrabajoSocial">
          <label for="ts">Trabajo Social </label>
          </div>
          <div class="radios">
          <input type="radio" name="especialidad" id="sec" value="Secundaria">
          <label for="sec">Secundaria </label>
          <input type="radio" name="especialidad" id="prim" value="Primaria">
          <label for="prim">Primaria </label>
          </div>
          </div>
          <div class="semestre">
            <h4>Semestre</h4>
            <p>
              *En caso de ser Secundaria elija uno de los primeros 3.*
            </p>
            <p>
              *En caso de ser Primaria elija una de las opciones a continuación.*
            </p>
            <div class="radios" id="primero">
            <input type="radio" name="sem" id="1L" value="1">
            <label for="1L">1° </label>
            </div>
            <div class="radios" id="segundo">
            <input type="radio" name="sem" id="2L" value="2">
            <label for="2L">2° </label>
            </div>
            <div class="radios" id="tercero">
            <input type="radio" name="sem" id="3L" value="3">
            <label for="3L">3° </label>
            </div>
            <div class="radios" id="cuarto">
            <input type="radio" name="sem" id="4L" value="4">
            <label for="4L">4° </label>
            </div>
            <div class="radios" id="quinto">
            <input type="radio" name="sem" id="5L" value="5">
            <label for="5L">5° </label>
            </div>
            <div class="radios" id="sexto">
            <input type="radio" name="sem" id="6L" value="6">
            <label for="6L">6° </label>
            </div>
          </div>
          <input type="submit" name="registrar" value="¡Registrarme!">
        </form>
      </div>
    </div>
  </div>
  <div class="col-xs-1 col-sm-3 col-md-4"></div>
</div>
<!--  Ventana Modal  -->
