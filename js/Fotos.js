$(document).on("ready", function(){
  // Poner fotos en grande
  // Función para centrar objetos
  function centrar(o, ho, wo){

    var aux1, aux2, hMiddle, wMiddle;

    wMiddle = -parseInt(wo.split("px")[0]) /2;
    hMiddle = -parseInt(ho.split("px")[0]) /2;

    o.css("margin-top", hMiddle + "px");
    o.css("margin-left", wMiddle + "px");

  }
  // ->Función para centrar objetos

function centrarImagenPrincipal(){
  for (var i = 0; i < $(".foto").length; i++) {
  var obj = $($(".foto")[i]).children(),
      w = "0px",
      h = $(obj).css("height");
  centrar(obj, h, w);
  }

  }
  centrarImagenPrincipal();
  //Función que obtiene los datos de la imagen para centrarla

  function obtenerDatos(){
  var height = $(".vmodal .contenido").css("height"),
      width = $(".vmodal .contenido").css("width"),
      img = $(".vmodal .contenido img");
      contenedor = $(".vmodal .contenido");


  var ho = $(".vmodal .contenido img").css("height"),
      wo = $(".vmodal .contenido img").css("width");
  centrar(contenedor, height, width);
  centrar(img, ho, wo);
  }

  // ->Función que obtiene los datos de la imagen para centrarla

  // Función que establece una imagen en el modal
  function establecerImagen(url, name){
    $(".vmodal .contenido img").attr("src", url);
    $(".vmodal .contenido img").attr("name", name);
    $(".vmodal").css("display", "block");

    obtenerDatos();
  }
  // ->Función que establece una imagen en el modal

  // Abrir imagen en grande
  $(".foto img").on("click", function(){
    $("html").css("overflow", "hidden");
    var url = $(this).attr("src"),
        name = $(this).attr("id");

    establecerImagen(url, name);
  });

  $(window).resize(function(){
    obtenerDatos();
    centrarImagenPrincipal();
  });
  // ->Abrir imagen en grande

  // Cerrar imagen en grande
  $("#cerrar").on("click", function(){
    $(".vmodal").css("display", "none");
    $("html").css("overflow-y", "scroll");
  });
  // ->Cerrar imagen en grande
  // ->Poner fotos en grande
  // Flechas de control

  // Siguiente
  $("#Siguiente").on("click", function(){
    var ident = $(this).parent().children("img").attr("name"),
        siguiente = parseInt(ident)  + 1;

    url = $("#" + siguiente).attr("src");

    if (url.split("/")[0] == "images") {
        establecerImagen(url, siguiente);
    }

  });
  // ->Siguiente

  // Anterior
  $("#Anterior").on("click", function(){
    var ident = $(this).parent().children("img").attr("name"),
        siguiente = parseInt(ident)  - 1;

    url = $("#" + siguiente).attr("src");

    if (url.split("/")[0] == "images") {
        establecerImagen(url, siguiente);
    }

  });
  // ->Anterior

  // ->Flechas de control
});
