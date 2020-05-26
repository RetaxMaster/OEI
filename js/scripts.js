function ocultarProceso(){
  $("#VentanaEspera").hide();
  $("#VentanaEspera h4").text("Estamos procesando su solcitud, esto puede tardar varios segundos, espera un momento por favor...");
  $("#VentanaEspera img").show();
}
$(document).on("ready", function(){

  $("#Titulo").on("click", function(){
    $("#Nots").slideToggle();
  });
  // Notificaciones
  // Notificacion
  function contarNotif(){
    var longitud = $("#Nots .notfContenedor").length,
        Titulo = $("#Titulo h4");
    if (longitud > 0) {
      $(Titulo).text("¡Tienes " + longitud + " notificaciones!");
    }
    else {
      $(Titulo).text("No tienes notificaciones nuevas.");
    }
  }

  function efectoEliminar(obj, duracion){
    function eliminarObjeto(){
    $(obj).hide("", "", "", function(){
    });
      $(obj).remove();
      contarNotif();
    }
    setTimeout(eliminarObjeto, duracion);
  }


  function elimNotif(not, duracion){

  if ($(not).attr("id").split("-")[0] == "notf") {
    var id = $(not).attr("id").split("-")[1];
  }
  else {
    var id = $(not).attr("id");
  }
    var datos = {
      "tipo":"EliminarNotificacion",
      "id": id
    }
    $.get("php/validacionesAjax.php", datos, function(res){
      if (res == "Exito") {
      efectoEliminar(not, duracion);
      }
    });
  }

  $(".notificacion span, .notfContenedor span").on("click", function(){
    $(this).attr("name", "Active");
  });

  $(".hrefNotf").on("click", function(e){
    var comprobar = $(this).children().children("span").attr("name");
    if (comprobar == "Active") {
      e.preventDefault();
      efectoEliminar(this, 0);
    }
    else {
      elimNotif(this, 0);
    }
  });

  $(".notfContenedor").on("click", function(e){
    var comprobar = $(this).children("span").attr("name");
    if (comprobar == "Active") {
      e.preventDefault();
    }
      elimNotif(this, 0);
  });

  // Eliminar al recibir
  function elm(){
  if ($(".hrefNotf").length > 0) {
    for (var i = 0; i < $(".hrefNotf").length; i++) {
      efectoEliminar($(".hrefNotf")[i], 4000);
      var datos = {
        tipo:"visto",
        id: $($(".hrefNotf")[i]).attr("id")
      }
      $.get("php/validacionesAjax.php", datos);
    }
  }
  }
  elm();
  // -> Eliminar al recibir
  // ->Notificacion
  function actualizar(){
    var datos = {
      tipo:"ObtenerUsuarioRol"
    }

    $.getJSON("php/validacionesAjax.php", datos, function(res2){
  var datos = {
    modo:'Notificaciones',
    usuario:res2.user
  }
  $.getJSON("php/TiempoReal.php", datos, function(res){
    var Asunto, Destinatario, Remitente, id, Rol;
    Asunto = res.Asunto;
    Destinatario = res.Destinatario;
    Remitente = res.Remitente;
    id= res.idObt;
    Rol = res.Rol;
    Nfilas = res.Filas;
    if (Asunto == "Comentario") {
      Asunto = "te ha mencionado en un comentario";
    }

    if (Rol == "Administrador" || Rol == "Asesor") {
      Remitente = "[" + Rol + "] " + Remitente;
    }

    var a = $("<a />", {
      "href":"Comentarios.php",
      "class":"hrefNotf",
      "id": id
    }),
        div = $("<div />", {"class":"notificacion"}),
        span = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"}),
        h4 = $("<h4 />"),
        br = $("<br />"),
        p = $("<p />");

        $(h4).text("¡Toc, Toc! Has recibido una nueva notificación.");
        p.text(Remitente + " " + Asunto);

        $(span).on("click", function(){
          $(this).attr("name", "Active");
        });

        $(a).on("click", function(e){
          var comprobar = $(this).children().children("span").attr("name");
          if (comprobar == "Active") {
            e.preventDefault();
            elimNotif(this, 0);
          }
        });

        $(div).append(span);
        $(div).append(h4);
        $(div).append(br);
        $(div).append(p);
        $(a).append(div);
        $(".Notificaciones").append(a);

        var a = $("<a />", {
          "href":"Comentarios.php",
          "class":"notfContenedor contenedores",
          "id": "notf-" + id
        }),
            span = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"}),
            p = $("<p />");

            p.text(Remitente + " " + Asunto);

            $(a).append(span);
            $(a).append(p);
            $("#Nots").append(a);

        $("#AudioNotificacion").get(0).play();
        setTimeout(function(){$("#AudioNotificacion").get(0).load();}, 1200);
        contarNotif();
        elm();
        actualizar();
  });
  });
  }
  actualizar();
  // -> Notificaciones

  //Validación del Login
    $("input[name='entrar']").on("click", function(e){
      e.preventDefault();
      var Nombre = $("#Nombre").val(),
          password = $("#password").val();
      if (Nombre == "" || password == "") {
        if (Nombre == "") {
          $("#Nombre").addClass("inputError");
        }
        else {
          $("#Nombre").removeClass("inputError");
        }

        if (password == "") {
          $("#password").addClass("inputError");
        }
        else {
          $("#password").removeClass("inputError");
        }
      }
      else {
        var datos = {
          "tipo":"Login",
          "user":Nombre,
          "pass":password
        }
        $.get("php/validacionesAjax.php", datos, function(res){
          if (res == "Correcto") {
            $("#Nombre").removeClass("inputError");
            $("#password").removeClass("inputError");
            $("#Nombre").attr("placeholder", "");
            $("#password").attr("placeholder", "");
            $("#Log").submit();
          }
          else {
            $("#Nombre").addClass("inputError");
            $("#password").addClass("inputError");
            $("#Nombre").val("");
            $("#password").val("");
            $("#Nombre").attr("placeholder", "Datos Incorrectos");
            $("#password").attr("placeholder", "Datos Incorrectos");
          }
        });
      }
    });
  //->Validación del Login

  //Validación del Registro
    $("input[name='registrar']").on("click", function(e){
      e.preventDefault();
      var submit = true;
      var Email = $("#Email").val(),
          RegNombre  = $("#RegNombre").val(),
          Regpassword  = $("#Regpassword").val(),
          rpassword  = $("#rpassword").val(),
          fecha  = $("#fecha").val(),
          OmegaUp = $("#Omegaup").val(),
          nCompleto = $("#Nombres").val(),
          Apellido = $("#Apellidos").val();

      var sexo = $("input[name='sexo']"),
          especialidad = $("input[name='especialidad']"),
          semestre = $("input[name='sem']");

      var sexo2, especialidad2, semestre2, a, b, c;

          for (var i = 0; i < sexo.length; i++) {
            if (sexo[i].checked) {
              sexo2 = $(sexo[i]).val();
              a = true;
              break;
            }
            else {
            sexo2 = "";
            a = false;
            }
          }

          if (a == false) {
            $(".sexo label").css("color", "#ff0000");
            submit = false;
          }
          else {
            $(".sexo label").css("color", "#000");
          }

          for (var i = 0; i < especialidad.length; i++) {
            if (especialidad[i].checked) {
              especialidad2 = $(especialidad[i]).val();
              b = true;
              break;
            }
            else {
              especialidad2 = "";
              b = false;
            }
          }

          if (b == false) {
            $(".especialidad label").css("color", "#ff0000");
            submit = false;
          }
          else {
            $(".especialidad label").css("color", "#000");
          }

          for (var i = 0; i < semestre.length; i++) {
            if (semestre[i].checked) {
              semestre2 = $(semestre[i]).val();
              c = true;
              break;
            }
            else {
              c = false;
              semestre2 = "";
            }
          }

          if (c == false) {
            $(".semestre label").css("color", "#ff0000");
            submit = false;
          }
          else {
            $(".semestre label").css("color", "#000");
          }

          if (Regpassword != rpassword) {
            e.preventDefault();
            $("#Regpassword").addClass("inputError");
            $("#rpassword").addClass("inputError");
            $("#Regpassword").val("");
            $("#rpassword").val("");
            $("#Regpassword").attr("placeholder", "Las contraseñas no coinciden");
            $("#rpassword").attr("placeholder", "Las contraseñas no coinciden");
            submit = false;
          }
          else{
            $("#Regpassword").removeClass("inputError");
            $("#rpassword").removeClass("inputError");
            $("#Regpassword").attr("placeholder", "");
            $("#rpassword").attr("placeholder", "");
          }

          if (Email == "" || RegNombre == "" || Regpassword == "" || rpassword == "" || fecha == "" || sexo2 == "" || especialidad2 == "" || semestre2 == "" || OmegaUp == "" || nCompleto == "" || Apellido == "") {
            submit = false;
            var login = $(".inputsText input");
            for (var i = 0; i < login.length; i++) {
              if($(login[i]).val() == ""){
                $(login[i]).addClass("inputError");
                $(login[i]).attr("placeholder", "Rellena este campo");
              }
              else {
                $(login[i]).removeClass("inputError");
                $("#Regpassword").attr("placeholder", "");
              }
            }
          }


          if (submit == true) {
          var datos = {
            "tipo":"registro",
            "username": RegNombre,
            "Omegaup":OmegaUp,
            "email": Email
          }

          //Valida si ya hay usuarios registradps con ese tag
          $.getJSON("php/validacionesAjax.php", datos, function(res){
            if (res.Usuario == "Verdadero" || res.Email == "Verdadero" || res.OmegaUp == "Verdadero") {
              if (res.Usuario == "Verdadero") {
                $("#RegNombre").addClass("inputError");
                $("#RegNombre").val("");
                $("#RegNombre").attr("placeholder", "Este usuario ya está en uso...");
              }
              else {
                $("#RegNombre").removeClass("inputError");
                $("#RegNombre").attr("placeholder", "");
              }

              if (res.Email == "Verdadero") {
                $("#Email").addClass("inputError");
                $("#Email").val("");
                $("#Email").attr("placeholder", "Este correo ya está en uso...");
              }
              else {
                $("#Email").removeClass("inputError");
                $("#Email").attr("placeholder", "");
              }

              if (res.OmegaUp == "Verdadero") {
                $("#Omegaup").addClass("inputError");
                $("#Omegaup").val("");
                $("#Omegaup").attr("placeholder", "Este usuario de OmegaUp ya está registrado...");
              }
              else {
                $("#Omegaup").removeClass("inputError");
                $("#Omegaup").attr("placeholder", "");
              }
            }
            else {
              $("#RegNombre, #Email, #Omegaup").removeClass("inputError");
              $("#reg").submit();
            }
          });
        }

    });
  //->Validación del Registro



  // Funcion para ocultar elementos al hacer click fuera de ellos
    $(".container-fluid, .encabezado").on("click", function(){
      $("nav").hide("slide", 180);
      $("#botonNav").css("display", "block");
    });
  // -<Funcion para ocultar elementos al hacer click fuera de ellos

  // Abre el modal de login y registro
  $("#registro, #reg").on("click", function(){
    $("nav").hide("slide", 180);
    $("#botonNav").css("display", "block");
    $("#LoginOrRegister").show("blind");
    $("#registrarse").click();
    $("html").css("overflow","hidden");
  });

  $("#loginNav").on("click", function(e){
    e.preventDefault();
    $("nav").hide("slide", 180);
    $("#botonNav").css("display", "block");
    $("#LoginOrRegister").show("blind");
    $("#entrar").click();
    $("html").css("overflow","hidden");
  });
  // ->Abre el modal de login y registro

  // Menú

  //Abre el menú
  $(".boton button").on("click", function(){
    $("#botonNav").css("display", "none");
    $("nav").show("slide", 180);
  });

  //Cierra el menú

  $(".header-nav span").on("click", function(){
    $("nav").hide("slide", 180);
    $("#botonNav").css("display", "block");
  });

  // -> Menú

  // Login/Register

  //Cerrar
  $("#cerrarL").on("click", function(){
    $("#LoginOrRegister").hide("blind");
    $("html").css("overflow-y", "scroll");
  });

  $("#entrar").on("click", function(){
    $(".formRegister").hide();
    $("#registrarse").removeClass("active");
    $(".formLogin").show();
    $("#entrar").addClass("active");
    $("#LoginOrRegister .contenido").css("margin", "10% 0");
  });

  $("#registrarse").on("click", function(){
    $(".formLogin").hide();
    $("#entrar").removeClass("active");
    $(".formRegister").show();
    $("#registrarse").addClass("active");
    $("#LoginOrRegister .contenido").css("margin", "0.5% 0");
  });

  //Oculta el input del 4° al clickar secundaria
  $("#prim").on("click", function(){
    $("#primero").hide();
    $("#segundo").hide();
    $("#tercero").hide();
    $("#cuarto").show();
    $("#quinto").show();
    $("#sexto").show();
    $("#1L").attr("checked", false);
    $("#2L").attr("checked", false);
    $("#3L").attr("checked", false);
  });

  $("#sec").on("click", function(){
    $("#primero").show();
    $("#segundo").show();
    $("#tercero").show();
    $("#cuarto").hide();
    $("#quinto").hide();
    $("#sexto").hide();
    $("#4L").attr("checked", false);
    $("#5L").attr("checked", false);
    $("#6L").attr("checked", false);
  });

  $("#p, #d, #ts").on("click", function(){
    $("#primero").show();
    $("#segundo").show();
    $("#tercero").show();
    $("#cuarto").show();
    $("#quinto").hide();
    $("#sexto").hide();
    $("#5L").attr("checked", false);
    $("#6L").attr("checked", false);
  });
  // ->Login/Register
});
