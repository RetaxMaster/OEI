$(document).on("ready", function(){
  $("#user").autocomplete({
    source: "php/validacionesAjax.php?tipo=BuscadorSugerencia"
  });

  $("#cerrar").on("click", function(){
    $("#ImgGrande").hide();
  });

  $("#cambiar").on("change", function(){
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Un momento por favor...");
    var fotoActual = $("#FotoDePerfil").attr("src").split("/")[1];
    var datos = {
      "tipo":"EliminarImagen",
      "nombre":fotoActual
    }

    $.get("php/validacionesAjax.php", datos, function(){
    var formData = new FormData($("#cpicture")[0]),
        ruta = "php/validacionesAjax.php?tipo=comprobarImagenYSubir";

    $.ajax({
      url:ruta,
      type: "POST",
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      success: function(res){
        $("#FotoDePerfil").attr("src", "images/" + res);
        var datos = {
          "tipo":"AgregarFotoDePerfilALaBaseDeDatos",
          "url":res
        }
        $.get("php/validacionesAjax.php", datos, function(){
          $("#VentanaEspera h4").text("¡Listo!");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 1000);
        });
      }
    });
    });
  });

  // Abrir para la galeria
  $("#change").on("click", function(){
    $("#cambiar").click();
  });

  function ponerUsuario(usuario){
    var datos = {
      "tipo":"Configuracion",
      "sesion":usuario
    }
    $("#FotoDePerfil").attr("src", "images/loader.gif");

    $.getJSON("php/validacionesAjax.php", datos, function(res){
      var Nombre, Cumpleaños, Sexo, Especialidad, Semestre, OmegaUp, Score, Edad, Dependencia, Foto, Usuario;

      Nombre = res.Nombre + " " + res.Apellido;
      Cumpleaños = res.Cumpleaños.split("-");
      Dependencia = res.Dependencia;
      Foto = "images/" + res.Foto;

      switch (Cumpleaños[1]) {
        case "01":
          Cumpleaños[1] = "Enero";
          break;

        case "02":
          Cumpleaños[1] = "Febrero";
          break;

        case "03":
          Cumpleaños[1] = "Marzo";
          break;

        case "04":
          Cumpleaños[1] = "Abril";
          break;

        case "05":
          Cumpleaños[1] = "Mayo";
          break;

        case "06":
          Cumpleaños[1] = "Junio";
          break;

        case "07":
          Cumpleaños[1] = "Julio";
          break;

        case "08":
          Cumpleaños[1] = "Agosto";
          break;

        case "09":
          Cumpleaños[1] = "Septiembre";
          break;

        case "10":
          Cumpleaños[1] = "Octubre";
          break;

        case "11":
          Cumpleaños[1] = "Noviembre";
          break;

        case "12":
          Cumpleaños[1] = "Diciembre";
          break;
      }

      Cumpleaños = Cumpleaños[2] + " de " + Cumpleaños[1];

      Sexo = res.Sexo;

      switch (res.Especialidad) {
        case "Programador":
        Especialidad = "Técnico Programador";
        Semestre = res.Semestre + '° "A"';
          break;

        case "Dietista":
        Especialidad = "Dietista";
        Semestre = res.Semestre + '° "C"';
          break;

        case "TrabajoSocial":
        Especialidad = "Trabajo Social";
        Semestre = res.Semestre + '° "B"';
          break;

        case "Primaria":
        Especialidad = "Primaria";
        Semestre = res.Semestre + '° "A"';
        break;

        default:
        Especialidad = "Secundaria";
        Semestre = res.Semestre + '° "A"';
      }

      Omegaup = res.OmegaUp;
      Score = res.Score;
      Edad = res.Edad + " años";
      Usuario = res.Usuario;

      if (Usuario != res.UsuarioActual) {
        $("#change").hide();
      }
      else {
        $("#change").show();
      }

      $("#Nombre").text(Nombre);
      $("#Edad").text(Edad);
      $("#Sexo").text(Sexo);
      $("#Semestre").text(Semestre);
      $("#especialidad").text(Especialidad);
      $("#fecha").text(Cumpleaños);
      $("#omega").text(Omegaup);
      $("#score").text(Score);
      $("#Dependencia").text(Dependencia);
      $("#FotoDePerfil").attr("src", Foto);
      $("#Usuario").text(Usuario);

    });
  }

  var usuario = $("#Nom").attr("name");
  ponerUsuario(usuario);

  $("#find").on("click", function(e){
    e.preventDefault();
    if ($("#user").val() == "") {
      $("#user").addClass("inputError");
    }
    else {
      $("#user").removeClass("inputError");
      $("#user").attr("placeholder", "");
      var datos = {
        "tipo":"checarExistencia",
        "usuario":$("#user").val(),
        "campo":"Usuario",
        "tabla":"usuarios"
      }
      $.get("php/validacionesAjax.php", datos, function(res){
        if ($("#user").val() == res) {
          ponerUsuario(res);
          $("#user").val("");
        }
        else {
          $("#user").addClass("inputError");
          $("#user").val("");
          $("#user").attr("placeholder", "Usuario no encontrado...");
        }
      });
    }
  });

  $("#Cambiar").on("click", function(e){
    e.preventDefault();
    if ($("#ca").val() == "" || $("#nc").val() == "" || $("#rc").val() == "") {
      //
      var input = $(".changeP input");
      for (var i = 0; i < input.length -1; i++) {
        if($(input[i]).val() == ""){
          $(input[i]).addClass("inputError");
          $(input[i]).attr("placeholder", "Rellena este campo");
        }
        else {
          $(input[i]).removeClass("inputError");
          $(input[i]).attr("placeholder", "");
        }
      }
      //
    }
    else {
      $(".changeP input").removeClass("inputError");
      if ($("#ca").val() == $("#nc").val()) {
        $("#ca").addClass("inputError");
        $("#ca").val("");
        $("#ca").attr("placeholder", "Las contraseñas son iguales...");
        $("#nc").addClass("inputError");
        $("#nc").val("");
        $("#nc").attr("placeholder", "Las contraseñas son iguales...");
        $("#rc").val("");
      }
      else{
        $("#ca").removeClass("inputError");
        $("#ca").attr("placeholder", "");
        $("#nc").removeClass("inputError");
        $("#nc").attr("placeholder", "");
      if ($("#nc").val() == $("#rc").val()) {
        $("#nc").removeClass("inputError");
        $("#rc").removeClass("inputError");
        $("#nc").attr("placeholder", "");
        $("#rc").attr("placeholder", "");
        var datos = {
          "tipo":"Login",
          "user": usuario,
          "pass": $("#ca").val()
        }
        var exito = $("<h3 />", {"id":"Cambiando"});
        $(exito).text("Cambiando...");
        $(exito).insertBefore($(".cp label:first"));
        $.get("php/validacionesAjax.php", datos, function(res){
          if(res == "Correcto"){
            $("#ca").removeClass("inputError");
            $("#ca").attr("placeholder", "");
            var datos = {
              "tipo":"cambiarC",
              "user": usuario,
              "nc": $("#nc").val()
            }
            $.get("php/validacionesAjax.php", datos, function(res){
              function borrar(){
                $("#Exito, #Error").remove();
              }
              if (res == "Exito") {
                $(exito).attr("id", "Exito");
                $(exito).text("¡Contraseña cambiada con éxito!");
              }
              else {
                $(exito).attr("id", "Error");
                $(exito).text("Oops, Algo salió mal =( Inténtalo de nuevo");
              }
              setTimeout(borrar, 3000);
              $("#ca").val("");
              $("#nc").val("");
              $("#rc").val("");
            });
          }
          else {
            $("#ca").addClass("inputError");
            $("#ca").val("");
            $("#ca").attr("placeholder", "Contraseña incorrecta...");
          }
        });
      }
      else {
        $("#nc").addClass("inputError");
        $("#rc").addClass("inputError");
        $("#nc").val("");
        $("#rc").val("");
        $("#nc").attr("placeholder", "Las contraseñas no coinciden");
        $("#rc").attr("placeholder", "Las contraseñas no coinciden");
      }
    }
    }
  });

  // ->Abrir para la galeria
});
