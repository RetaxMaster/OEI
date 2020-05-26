$(document).on("ready", function(){

  if ($(".comentario").length < 10) {
    $("#Paginacion").remove();
  }

  function crearComentario(idd, Img, Fecha, Rol, Usuario, contenido, Imagen, usuarioAct, RolAct){
    var div = $("<div />", {"class":"contenedores comentario", "id":idd}),
        fecha = $("<div />", {"class":"Fecha"}),
        elim = $("<div />", {"class":"elim"}),
        coment = $("<div />", {"class":"coment"}),
        h5 = $("<h5 />"),
        h4 = $("<h4 />"),
        span = $("<span />", {"class":"glyphicon glyphicon-remove eliminar pull-right"}),
        dvImg = $("<div />", {"class":"imagen col-xs-3 col-sm-1"}),
        dvCom = $("<div />", {"class":"comenta col-xs-9 col-sm-11"}),
        img = $("<img />", {"src": "images/" + Img, "alt":"Foto de Perfil"});

        $(img).on("click", function(){
          $("html").css("overflow", "hidden");
          var url = $(this).attr("src"),
              name = $(this).attr("id");

          establecerImagen(url, name);
        });

        $(h5).text(Fecha);

        $(h4).text("[" + Rol + "] " + Usuario + ":");


        $(span).on("click", function(){
          var obj = $(this).parent().parent();
          eliminar(obj, idd);
        });

        $(elim).append(span);
        $(fecha).append(h5);
        $(fecha).append(h4);
        $(dvImg).append(img);
        if (contenido != "") {
          p = $("<p />"),
          $(p).text(contenido);
          $(dvCom).append(p);
        }
        if (Imagen != "") {
          var fot = $("<div>", {"class":"imagen col-md-6"}),
              fotCent1 = $("<div>", {"class":"col-md-3"}),
              fotCent2 = $("<div>", {"class":"col-md-3"}),
              imgS = $("<img />", {"src": "images/" + Imagen, "alt":"Imagen del usuario"});

            $(imgS).on("click", function(){
              $("html").css("overflow", "hidden");
              var url = $(this).attr("src"),
                  name = $(this).attr("id");

              establecerImagen(url, name);
            });
            $(fot).append(imgS);
            $(dvCom).append(fotCent1);
            $(dvCom).append(fot);
            $(dvCom).append(fotCent2);
            $("#Img").val("");
        }
        $(coment).append(dvImg);
        $(coment).append(dvCom);
        $(div).append(fecha);

        if (Usuario == usuarioAct || RolAct == "Administrador" || RolAct == "Asesor") {
          if (Rol != "Administrador" || Usuario == usuarioAct) {
            $(div).append(elim);
          }
        }

        $(div).append(coment);
        return div;
  }

  // Paginación
  var paginacion = 10;
  $("#Paginacion").on("click", function(){
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera un momento");
    var datos = {
      "tipo":"PaginacionComents",
      "Paginacion":paginacion
    }
    $.getJSON("php/validacionesAjax.php", datos, function(res){
        if (res.Exito == "Exito") {
      for(var x = 0; x < res.idd.length; x++) {
        div = crearComentario(res.idd[x], res.Img[x], res.Fecha[x], res.Rol[x], res.Usuario[x], res.contenido[x], res.Imagen[x], res.usuarioAct, res.RolAct);
      $(".Comentarios").append(div);
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

  // Imagenes
  //
  $("#cerrarImg").on("click", function(){
    $("#ModalFotos").hide();
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
    var height = $("#ModalFotos .contenido").css("height"),
        width = $("#ModalFotos .contenido").css("width"),
        img = $("#ModalFotos .contenido img");
        contenedor = $("#ModalFotos .contenido");


    var ho = $("#ModalFotos .contenido img").css("height"),
        wo = $("#ModalFotos .contenido img").css("width");
    centrar(contenedor, height, width);
    centrar(img, ho, wo);
    }

    // ->Función que obtiene los datos de la imagen para centrarla

    // Función que establece una imagen en el modal
    function establecerImagen(url, name){
      $("#ModalFotos .contenido img").attr("src", url);
      $("#ModalFotos .contenido img").attr("name", name);
      $("#ModalFotos").css("display", "block");

      obtenerDatos();
    }
    // ->Función que establece una imagen en el modal

    // Abrir imagen en grande
    $(".comentario .imagen img").on("click", function(){
      $("html").css("overflow", "hidden");
      var url = $(this).attr("src"),
          name = $(this).attr("id");

      establecerImagen(url, name);
    });

    $(window).resize(function(){
      obtenerDatos();
    });
  //
  // ->Imagenes

  // Comentarios en T real
       function Treal(){
         var datos = {
           "modo":"treal"
         }
         $.getJSON("php/TiempoReal.php", datos, function(data){

                div = crearComentario(data.idd, data.Img, data.Fecha, data.Rol, data.Usuario, data.contenido, data.Imagen, data.usuarioAct, data.RolAct);
               if ($(".comentario").length > 0) {
                 $(div).insertBefore($(".comentario:first"));
               }
               else {
               $(".Comentarios").append(div);
             }
             comp();
           Treal();
         });
       }
       Treal();


  // -> Comentarios en T real

  function etiquetado(texto){
    var users = "";
    for (var i = 0; i < texto.length; i++) {
      if(texto[i] == "@"){
        var userEtiquetado = "", j = i+1;
        while (texto[j] != " " && texto[j] != "@" && texto[j] != "," && texto[j] != "." && j != texto.length) {
          userEtiquetado += texto[j];
          j++;
        }
        users += userEtiquetado +".";
      }
    }
    return users;
  }

  $("#regs, #log").on("click", function(e){
    e.preventDefault();
    $("#LoginOrRegister").show("blind");
    if ($(this).attr("id") == "regs") {
    $("#registrarse").click();
    }
    else {
      $("#entrar").click();
    }
  });

  function comp(){
    if ($(".comentario").length == 0 && $(".nopubs").length == 0) {
      var div = $("<div />", {"class":"contenedores nopubs"}),
          h3 = $("<h3 />");

          $(h3).text("No hay comentarios que mostrar");
          $(div).append(h3);
          $(".Comentarios").append(div);
    }
    else {
      $(".nopubs").remove();
    }
  }
  comp();
  function eliminar(obj, id){
    $("#sure").show("Puff");

    $("#no").on("click", function(){
      $("#sure").hide("Puff");
    });
    $("#si").on("click", function(){
        $("#sure").hide("Puff");

    var datos = {
      "tipo":"eliminar",
      "id":id,
      "tabla":"comentarios"
    }

    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera un momento, estamos eliminando el comentario...");

    $.get("php/validacionesAjax.php", datos, function(res){
      if (res == "Exito") {
        var img = $(obj).children(".coment").children(".comenta").children(".imagen").children().attr("src");
        if (img) {
          img = img.split("/")[1];
        var datos = {
          "tipo":"EliminarImagen",
          "nombre":img
        }
        $.get("php/validacionesAjax.php", datos);
        }
        $("#VentanaEspera h4").text("Comentario eliminado con éxito");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 1500);
        $(obj).remove();
        comp();
        revisarTabla();
      }
    });
      });
  }

  $(".eliminar").on("click",function(){
    var obj = $(this).parent().parent();
    var id = $(obj).attr("id");
    eliminar(obj, id);
  });

  $("#pub").on("click", function(){
    var file = $("#Img")[0].files[0];
    var contenido = $("#Comentarios").val();
    if (contenido == "" && !file) {
      $("#Comentarios").addClass("inputError");
    }
    else {
      $("#Comentarios").removeClass("inputError");
      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Estamos subiendo tu comentario, espera...");

      etiquetas = etiquetado(contenido);
        var formData = new FormData($("#NuevoCom")[0]),
            ruta = "php/validacionesAjax.php?tipo=comprobarImagenYSubir";

        $.ajax({
          url:ruta,
          type: "POST",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: function(res6){
            if (res6 == "Esta no es una imagen") {
              $("#VentanaEspera h4").text(res6);
              $("#VentanaEspera img").hide();
              setTimeout(ocultarProceso, 2500);
            }
            else {
      var datos = {
        "tipo":"NuevoComent",
        "com":contenido,
        "etiquetas":etiquetas,
        "img":res6
      }

      $.getJSON("php/validacionesAjax.php", datos, function(){
        $("#VentanaEspera h4").text("¡Listo!");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 1000);
        $("#Comentarios").val("");
        $("#Img").val("");
      });
      }
    }
    });
    }
  });
});
