$(document).on("ready", function(){

  if ($(".articulo").length < 10) {
    $("#Paginacion").remove();
  }

  function crearPublicacion(idd, Fecha, Publicacion, Imagen){
    var div = $("<div />", {"class":"articulo contenedores", "id":idd}),
    divHeader = $("<div />", {"class":"header"}),
    divFecha = $("<div />", {"class":"fecha"}),
    divCerrar = $("<div />", {"class":"cerrar"}),
    h5 = $("<h5 />", {"class":"FechaPub"}),
    span = $("<span />", {"class":"glyphicon glyphicon-remove pull-right EliminarPub"});




    // Asignamos valores

    h5.text(Fecha);

    // Metemos elementos

    $(divCerrar).append(span);
    $(divFecha).append(h5);
    $(divHeader).append(divFecha);
    var datos2 = {
      tipo: "ObtenerUsuarioRol"
    }
    $.getJSON("php/validacionesAjax.php", datos2, function(res2){
      if (res2.rol == "Administrador" || res2.rol == "Asesor") {
        $(divHeader).append(divCerrar);
      }
    });
    $(div).append(divHeader);
    $(div).append(p);

    if (Publicacion != "") {
    var p = $("<p />");
    p.text(Publicacion);
    $(div).append(p);
  }
    if (Imagen != "") {
      var divPadreImg = $("<div />", {"class":"image"}),
          imgCentr1 = $("<div />", {"class":"col-sm-1"}),
          imgCentr2 = $("<div />", {"class":"col-sm-1"}),
          divImg = $("<div />", {"class":"imagen col-sm-10 foto"}),
          img = $("<img />", {
            "src": "images/" + Imagen,
            "alt":"Imagen"
          });

      $(divImg).append(img);
      $(divPadreImg).append(imgCentr1);
      $(divPadreImg).append(divImg);
      $(divPadreImg).append(imgCentr2);
      $(img).on("click", function(){
        $("html").css("overflow", "hidden");
        var url = $(this).attr("src"),
            name = $(this).attr("id");

        establecerImagen(url, name);
      });
      $(div).append(divPadreImg);
    }

    $(span).on("click", eliminar);

    return div;
  }

  //  Paginación
  var paginacion = 10;
  $("#Paginacion").on("click", function(){
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera un momento");
    var datos = {
      "tipo":"Paginacion",
      "Paginacion":paginacion
    }
    $.getJSON("php/validacionesAjax.php", datos, function(res){
        if (res.Exito == "Exito") {
      for(var x = 0; x < res.idd.length; x++) {
      div = crearPublicacion(res.idd[x], res.Fecha[x], res.Publicacion[x], res.Imagen[x]);
      $(".Publicaciones").append(div);
      }
      paginacion = res.Pag;
      ocultarProceso();
      }
      else {
        $("#VentanaEspera h4").text("No hay más publicaciones que mostrar");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 2500);
      }
    });
  });
  // -> Paginación
  //
  $("#cerrarImg").on("click", function(){
    $("#ImagenGrande").hide();
    $("html").css("overflow-y", "scroll");
  });
  // Función para centrar objetos
  function centrar(o, ho, wo){

    var aux1, aux2, hMiddle, wMiddle;

    wMiddle = -parseInt(wo.split("px")[0]) /2;
    hMiddle = -parseInt(ho.split("px")[0]) /2;

    o.css("margin-top", hMiddle + "px");
    o.css("margin-left", wMiddle + "px");

  }
  // ->Función para centrar objetos

    function obtenerDatos(){
    var height = $("#ImagenGrande .contenido").css("height"),
        width = $("#ImagenGrande .contenido").css("width"),
        img = $("#ImagenGrande .contenido img");
        contenedor = $("#ImagenGrande .contenido");


    var ho = $("#ImagenGrande .contenido img").css("height"),
        wo = $("#ImagenGrande .contenido img").css("width");
    centrar(contenedor, height, width);
    centrar(img, ho, wo);
    }

    // ->Función que obtiene los datos de la imagen para centrarla

    // Función que establece una imagen en el modal
    function establecerImagen(url, name){
      $("#ImagenGrande .contenido img").attr("src", url);
      $("#ImagenGrande .contenido img").attr("name", name);
      $("#ImagenGrande").css("display", "block");

      obtenerDatos();
    }
    // ->Función que establece una imagen en el modal

    // Abrir imagen en grande
    $(".image .imagen img").on("click", function(){
      $("html").css("overflow", "hidden");
      var url = $(this).attr("src"),
          name = $(this).attr("id");

      establecerImagen(url, name);
    });

    $(window).resize(function(){
      obtenerDatos();
    });
  //


// Agregar y eliminar Alumnos
$("#goAlumn").on("click", function(e){
  e.preventDefault();
  if($("#newAlumn").val() == ""){
    $("#newAlumn").addClass("inputError");
  }
  else {
    $("#newAlumn").removeClass("inputError");
    var usuario = $("#newAlumn").val();
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera un momento, estamos agregando a " + usuario + " como Alumno, un momento por favor...");
  var datos = {
    "tipo":"Alumno",
    "accion":"Agregar",
    "usuario": usuario
  }
  $.get("php/validacionesAjax.php", datos, function(res){
    if(res == "Exito"){
      $("#VentanaEspera h4").text("El alumno se ha agregado exitosamente");
      $("#VentanaEspera img").hide();
      setTimeout(ocultarProceso, 1500);
    }
    else {
      $("#VentanaEspera h4").text("Oops, ha surgido un error, intentelo de nuevo. ERROR: " + res);
      $("#VentanaEspera img").hide();
      setTimeout(ocultarProceso, 2500);
    }
    $("#newAlumn").val("");
  });
}
});

$("#elAlumno").on("click", function(e){
  e.preventDefault();
  if($("#delAlumn").val() == ""){
    $("#delAlumn").addClass("inputError");
  }
  else {
    $("#delAlumn").removeClass("inputError");
    var usuario = $("#delAlumn").val();
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera un momento, estamos eliminando a " + usuario + " como Alumno, un momento por favor...");
  var datos = {
    "tipo":"Alumno",
    "accion":"Eliminar",
    "usuario": usuario
  }
  $.get("php/validacionesAjax.php", datos, function(res){
    if(res == "Exito"){
      $("#VentanaEspera h4").text("El alumno ha sido eliminado exitosamente");
      $("#VentanaEspera img").hide();
      setTimeout(ocultarProceso, 1500);
    }
    else {
      $("#VentanaEspera h4").text("Oops, ha surgido un error, intentelo de nuevo. ERROR: " + res);
      $("#VentanaEspera img").hide();
      setTimeout(ocultarProceso, 2500);
    }
    $("#delAlumn").val("");
  });
}
});
// -> Agregar y eliminar Alumnos




  $("#est").on("click", function(e){
    e.preventDefault();
    if ($("#lug").val() == "") {
      $("#lug").addClass("inputError");
    }
    else {
      $("#lug").removeClass("inputError");
      var datos = {
        "tipo":"sede",
        "lugar":$("#lug").val()
      }

      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Espera un momento, estamos estableciendo la cede...");

      $.get("php/validacionesAjax.php", datos, function(){
        $("#VentanaEspera h4").text("¡Listo!");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 1500);
        $(".sede h4").text("Lugar de la próxima sede: " + $("#lug").val());
        $("#lug").val("");
      });
    }
  });

  function checarNumPubs(){
    if ($(".articulo").length == 0) {
      var div = $("<div />", {"class":"articulo contenedores nopubs"}),
          h3 = $("<h3 />");

          $(h3).text("No hay publicaciones que mostrar");
          $(div).append(h3);
          $(".Publicaciones").append(div);
    }
    else{
      $(".nopubs").remove();
    }
  }
  checarNumPubs();

  $("#elAsesor").on("click", function(e){
    e.preventDefault();
    if ($("#delAsesor").val() == "") {
      $("#delAsesor").addClass("inputError");
    }
    else {
      $("#delAsesor").removeClass("inputError");
      var AsesorAEliminar = $("#delAsesor").val();
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Espera, estamos quitandole la dependencia de Asesor a " + AsesorAEliminar + ", espera un momento por favor...");
      var datos = {
        "tipo":"delAsesor",
        "user":AsesorAEliminar
      }

      $.get("php/validacionesAjax.php", datos, function(res){
        if (res == "Exito") {
          $("#VentanaEspera h4").text("¡Se ha eliminado este asesor correctamente!");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 1500);
          $("#addAses").hide();
          $("#delAsesor").val("");
        }
        else {
          $("#VentanaEspera h4").text("Oops, ha ocurrido un error, vuelve a intentarlo. Error: " + res);
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 2500);
        }
      });
    }
  });

  $("#cerrar").on("click", function(){
    $("#addAses").hide();
  });

  $(".agregar").on("click", function(){
    $("#addAses").show();
  });

  $("#goAsesor").on("click", function(e){
    e.preventDefault();
    if($("#newAsesor").val() == ""){
      $("#newAsesor").addClass("inputError");
      $("#newAsesor").attr("placeholder", "Rellena este campo...");
    }
    else {
      $("#newAsesor").removeClass("inputError");
      $("#newAsesor").attr("placeholder", "");
      $("#VentanaEspera img").hide();
      var nuevoAsesor = $("#newAsesor").val();
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Espera, estamos agregando a " + nuevoAsesor + " como un nuevo asesor, espera un momento por favor...");

      var datos = {
        "tipo":"nuevoAsesor",
        "asesor":nuevoAsesor
      }

      $.get("php/validacionesAjax.php", datos, function(res){
        if (res == "Exito") {
          $(".vmodal").hide();
          $("#VentanaEspera h4").text("¡Se ha agregado este asesor exitosamente!");
          $("#VentanaEspera img").hide();
          $("#newAsesor").val("");
          setTimeout(ocultarProceso, 1500);
        }
        else {
          $("#VentanaEspera h4").text("Oops, ha ocurrido un error, intentelo de nuevo. Error: " + res);
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 2500);
        }
      });
    }
  });

  function eliminar(){
      $("#sure").show("fold");

      var obj = $(this).parent().parent().parent();
      var objImg = $(this).parent().parent().parent().children(".image");

      $("#no").on("click", function(){
        $("#sure").hide("fold");
      });

      $("#si").on("click", function(){
        $("#sure").hide("fold");
        $("#VentanaEspera").show();
        $("#VentanaEspera h4").text("Espera, estamos eliminando la publicación...");
        if ($(objImg).attr("class")) {
          var nombre = $(objImg).children(".imagen").children().attr("src").split("/")[1];
          var datos2 = {
            "tipo":"EliminarImagen",
            "nombre": nombre
          }
          $.get("php/validacionesAjax.php", datos2);
        }

        var datos = {
          "tipo":"eliminar",
          "tabla":"publicaciones",
          "id":$(obj).attr("id")
        }

        $.get("php/validacionesAjax.php", datos, function(res){
          if (res == "Exito") {
          $("#VentanaEspera h4").text("¡Publicación Eliminada!");
          $("#VentanaEspera img").hide();
          $(obj).remove();
          checarNumPubs();
          setTimeout(ocultarProceso, 1500);
          }
          else{
            $("#VentanaEspera h4").text("Oops, surgió un error, inténtalo de nuevo" + res);
            $("#VentanaEspera img").hide();
            setTimeout(ocultarProceso, 2500);
          }
        });
      });
  }

  $(".EliminarPub").on("click", eliminar);

  function PubsTiempoReal(){
    var datos = {
      modo:"Publicaciones"
    }

    $.getJSON("php/TiempoReal.php", datos, function(res){ //
    div = crearPublicacion(res.idd, res.Fecha, res.Publicacion, res.Imagen);
    // Metemos al documento
    if ($(".articulo").length > 0) {
    $(div).insertBefore($(".articulo:first"));
    }
    else {
    $(".Publicaciones").append(div);
    }

    checarNumPubs();
    PubsTiempoReal();
    });
  }
  PubsTiempoReal();

  $("#Publicar").on("click", function(e){
    e.preventDefault();
    var file = $("#imgPublic")[0].files[0];

    //Obtengo Datos
    var datos = {
      "tipo": "ObtenerHora"
    }

    $.get("php/validacionesAjax.php", datos, function(res){
    var texto = $(".publicacion textarea").val(),
        fecha = res;

        if (texto == "" && !file) {
          $(".publicacion textarea").addClass("inputError");
        }
    else{
      $(".publicacion textarea").removeClass("inputError");

      var formData = new FormData($("#formPubaAdm")[0]),
          ruta = "php/validacionesAjax.php?tipo=comprobarImagenYSubir";

      $.ajax({
        url:ruta,
        type: "POST",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#VentanaEspera").show();
        },
        success: function(res5){


          //
          if (res5 != "Esta no es una imagen") {
            $("#imgPublic").css("border","none");
          var datos = {
          "tipo":"nuevaPub",
          "pub":texto,
          "fecha":fecha,
          "img":res5
          }

          $.get("php/validacionesAjax.php", datos, function(){
            $("#VentanaEspera h4").text("¡Listo!");
            $("#VentanaEspera img").hide();
            setTimeout(ocultarProceso, 1500);
            $(".publicacion textarea").val("");
            $("#imgPublic").val("");
          });
          }
          else {
          $("#imgPublic").css("border","2px solid #ff0000");
          $("#VentanaEspera h4").text(res5);
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 2500);
          }
          //
        }
      });
      }
    });

  });
});
