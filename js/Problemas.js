$(document).on("ready", function(){

  function checarNumPubs(){
    if ($(".problema").length == 0) {
      var div = $("<div />", {"class":"contenedores nopubs"}),
          h3 = $("<h3 />");

          $(h3).text("No hay problemas que mostrar");
          $(div).append(h3);
          $(".Problemas").append(div);
    }
    else{
      $(".nopubs").remove();
    }
  }
  checarNumPubs();
  //Eliminar Problemas

  function ElimP(e){
    e.preventDefault();
    var elementoAEliminar = $(this).parent().parent().parent().parent();
    $("#sure").show();
    $("#no").on("click", function(){
      $(".vmodal").css("display", "none");
    });

    $("#si").on("click", function(){
      $("#sure").hide();
      var datos = {
        "tipo":"eliminar",
        "tabla":"problemas",
        "id": $(elementoAEliminar).attr("id")
      }
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("¡Se ha eliminado el problema!");
      $.get("php/validacionesAjax.php", datos, function(res){
        if (res == "Exito") {
          $("#VentanaEspera h4").text("¡Se ha eliminado el problema!");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 1500);
          $(elementoAEliminar).remove();
          checarNumPubs();
        }
      });
    });
  }

  $(".eliminar span").on("click", ElimP);

  $("#reg").on("click", function(e){
    e.preventDefault();
    $("#registrarse").click();
    $("#LoginOrRegister").show("blind");
  });


  // ->Eliminar Problemas

  // Agregar problemas
  $(".agregar").on("click", function(){
    $(".vmodalButtonPlus").show();
  });

  $(".closeP").on("click", function(){
    $(".vmodalButtonPlus").hide();
  });

  $("#agregar").on("click", function(){
    //condicion para campos vacios

    var nProblema = $("#nProblema").val(),
        Lenguajes = $("#Lenguajes").val(),
        Enlace = $("#Enlace").val(),
        Descripcion = $("#Descripcion").val();

    if (nProblema == "" || Lenguajes == "" || Enlace == "" || Descripcion == "") {

      if (nProblema == "") {
        $("#nProblema").addClass("inputError");
      }
      else {
        $("#nProblema").removeClass("inputError");
      }

      if (Lenguajes == "") {
        $("#Lenguajes").addClass("inputError");
      }
      else {
        $("#Lenguajes").removeClass("inputError");
      }

      if (Enlace == "") {
        $("#Enlace").addClass("inputError");
      }
      else {
        $("#Enlace").removeClass("inputError");
      }

      if (Descripcion == "") {
        $("#Descripcion").addClass("inputError");
      }
      else {
        $("#Descripcion").removeClass("inputError");
      }

    }
    else{
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Estamos creando el problema, un momento porfavor...");
    //Obtengo datos del formulario
    var NombreP = $("#nProblema").val(),
        Lenguajes = $("#Lenguajes").val(),
        url = $("#Enlace").val(),
        descripcion = $("#Descripcion").val();

    var datos = {
      "tipo":"nuevoProblema",
      "Nombre":NombreP,
      "Lenguajes":Lenguajes,
      "url":url,
      "descripcion":descripcion
    }

    $.get("php/validacionesAjax.php", datos, function(res){
      if (res == "Exito") {
        var datos = {
          "tipo":"ObtenerElemento",
          "campoASeleccionar":"id",
          "tabla":"problemas"
        }

      $.getJSON("php/validacionesAjax.php", datos, function(res2){
        if (res2.Exito == "Exito") {
          $("#VentanaEspera h4").text("¡El problema se ha agregado exitosamente!");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 1500);
      //Creo el nuevo problema
      var dvPrin = $("<div />", {"class":"problema","id":res2.campo}),
          a = $("<a />", {
            "target":"_blank",
            "href": url
          }),
          dvHeader = $("<div />", {"class":"headerProb"}),
          dvContent = $("<div />", {"class":"contenido"}),
          p = $("<p />"),
          h4 = $("<h4 />"),
          span = $("<span />", {"class":"lenguajes"}),
          dvElim = $("<div />", {"class":"eliminar"}),
          spanElim = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"});

          $(h4).text(NombreP + " ");
          $(span).text(Lenguajes);
          $(p).text(descripcion);

          $(spanElim).on("click", ElimP);

          $(dvElim).append(spanElim);
          $(h4).append(span);
          $(dvHeader).append(h4);
          $(dvHeader).append(dvElim);
          $(dvContent).append(p);
          $(a).append(dvHeader);
          $(a).append(dvContent);
          $(dvPrin).append(a);

          if ($(".problema").length > 0) {
            $(dvPrin).insertBefore($(".problema:first"));
          }
          else {
          $(".Problemas").append(dvPrin);
          }
          $(".vmodalButtonPlus").hide();
          checarNumPubs();
        }
      });
      }
      else{
        $("#VentanaEspera h4").text("Oops, ha ocurrido un error, inténtalo de nuevo");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 2500);
      }
    });
  }
  });


  // ->Agregar problemas
});
