$(document).on("ready", function(){
  $(".agregar").on("click", function(){
    $("#Na").show();
  });

  $("#cerrar").on("click", function(){
    $("#Na").hide();
  });

  $("#agregarAl").on("click", function(){
    var c = 0, obj = $(".exoei input");

    for (var i = 0; i < obj.length -1; i++) {
      if($(obj[i]).val() == ""){
        c++;
        $(obj[i]).addClass("inputError");
      }
      else {
        $(obj[i]).removeClass("inputError");
      }
    }

    for (var i = 0; i < $(".especialidad .radios").children("input").length; i++) {
      if ($(".especialidad .radios").children("input")[i].checked) {
        var Especialidad = $($(".especialidad .radios").children("input")[i]).attr("value");
      }
    }

    if (!Especialidad) {
      c++;
      $(".especialidad .radios").css("color", "#ff0000");
    }
    else {
      $(".especialidad .radios").css("color", "#000");
    }


    if (c == 0) {
      $(".exoei input").removeClass("inputError");
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Agregando...");
    //Obtengo datos
    var Nombre = $("#NombreN").val(),
        Semestre = $("#SemestreN").val(),
        Lugar = $("#LugarN").val(),
        Posicion = $("#PosicionN").val(),
        Anio = $("#AnioN").val(),
        Puntaje = $("#PuntajeN").val();

        Semestre += '° "' + Especialidad + '"';

    var datos = {
      "tipo":"NuevoExoei",
      "Nombre": Nombre,
      "Semestre": Semestre,
      "Lugar": Lugar,
      "Posicion": Posicion,
      "Anio": Anio,
      "Puntaje": Puntaje
    }

    $.get("php/validacionesAjax.php", datos, function(){
      $("#VentanaEspera h4").text("¡Listo!");
      $("#VentanaEspera img").hide();
      setTimeout(ocultarProceso, 1000);
      $(".exoei input[type='text']").val("");
      $("#rank").load("overall/rank.php #Ranking");

      $("#Na").hide();
      $("#rank").load("overall/rank.php #Ranking");
    });
  }
  });
    $("#rank").load("overall/rank.php #Ranking");
});
