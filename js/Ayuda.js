$(document).on("ready", function(){

  function checarNumPubs(Dep){
    if ($("#"+Dep).children("a").length == 0) {
      if ($("#N"+Dep).length == 0) {
      var div = $("<div />", {"class":"contenedores nopubs", "id":"N"+Dep}),
          h4 = $("<h4 />");

          $(h4).text("No hay ayuda que mostrar");
          $(div).append(h4);
          $("#"+Dep).append(div);
        }
    }
    else{
      $("#N"+Dep).remove();
    }
  }
  checarNumPubs("CKp");
  checarNumPubs("CKj");
  checarNumPubs("Ccpp");
  checarNumPubs("Lb");
  checarNumPubs("Rb");

  function trim(cadena){
    var c = cadena.split(" ").join("");
    return c;
  }

  function eliminar(ew){
    $("#sure").show();
    $("#si").on("click", function(){
    $("#sure").hide();
    $("#VentanaEspera").show();
    $("#VentanaEspera h4").text("Espera, estamos eliminando la ayuda...");
    var obj = ew;
    var datos = {
      "tipo":"eliminar",
      "id":$(obj).attr("id"),
      "tabla":"ayuda"
    }
    $.get("php/validacionesAjax.php", datos, function(res){
      if (res == "Exito") {
        $("#VentanaEspera h4").text("Ayuda eliminada con éxito");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 1500);
        $(obj).remove();
        checarNumPubs("CKp");
        checarNumPubs("CKj");
        checarNumPubs("Ccpp");
        checarNumPubs("Lb");
        checarNumPubs("Rb");
      }
    });
    });
    $("#no").on("click", function(){
      $(ew).children().children().children().attr("name","");
      $("#sure").hide();
    });
  }

  $("#Karel").on("click", function(){
    $(".contenidoP").slideToggle();
  });

  $("#Cpp, #Libinteractive, #Kp, #Kj, #Robotica").on("click", function(){
    $(this).parent().children(".contenido").slideToggle();
  });

  $(".bloqueado").on("click", function(e){e.preventDefault();});

  $(".agregar").on("click", function(){
    $("#nt").show();
  });

  $(".EliminarPub").on("click", function(){
    $(this).attr("name", "true")
  });

  function checar(){
  $(".seccion").parent().on("click", function(e){
    if ($(this).children().children().children().attr("name") == "true") {
      e.preventDefault();
      eliminar(this);
    }
  });
  }
  checar();


  $("#cerrar").on("click", function(){
    $(".vmodal").hide();
  });

  // Agregar contenido
  var label, input, div, radio1, radio2, h5, div2, lradio1, lradio2, file, lfile;
  var br = $("<br />"), c = 0, x=0;

  $("#h2").on("click", function(){
    c++;
    cerrar = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"});

    $(cerrar).on("click", function(){
      $(this).parent().remove(); x++;
    });

    label = $("<label />", {"class":"input"}),
    input = $("<input />", {
      "type":"text",
      "placeholder":"Inserta el título",
      "class":"titulo"
    });

    $(label).text("Título:");
    $(label).append(cerrar);
    $(label).append(br);
    $(label).append(input);

    $(".inputs").append(label);
    $(".inputs").append(br);
  });

  $("#h4").on("click", function(){
    c++;
    cerrar = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"});
    $(cerrar).on("click", function(){$(this).parent().remove(); x++;});
    label = $("<label />", {"class":"input"}),
    input = $("<input />", {
      "type":"text",
      "placeholder":"Inserta el subtítulo",
      "class":"subtitulo"
    });

    $(label).text("Subtítulo:");
    $(label).append(cerrar);
    $(label).append(br);
    $(label).append(input);

    $(".inputs").append(label);
    $(".inputs").append(br);
  });

  $("#img").on("click", function(){
    c++; // <- Aumento la cantidad de inputs radio
    cerrar = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"})
    $(cerrar).on("click", function(){
      $(this).parent().parent().parent().remove(); x++;
    });
    // Creo los elementos
    div = $("<div />", {"class":"img"}),
    form = $("<form />", {
      "class":"addImage",
      "id":"form"+c,
      "action":"#",
      "method":"post",
      "enctype":"multipart/form-data"
    }),
    label = $("<label />", {"class":"input nombre"}),
    input = $("<input />", {
      "type":"file",
      "class":"imagen",
      "name":"file",
      "id":c
    });

    // Asgino valores

    $(label).text("Selecciona la imagen:");
    //Inserto elementos


    $(label).append(cerrar);
    $(label).append(br);
    $(label).append(input);
    $(div).append(label);
    $(div).append(br);
    $(form).append(div);

    //Inserto en el documento
    $(".inputs").append(form);

  });

  $("#parr").on("click", function(){
    c++;
    cerrar = $("<span />", {"class":"glyphicon glyphicon-remove pull-right"});
    $(cerrar).on("click", function(){$(this).parent().remove(); x++;});
    label = $("<label />", {"class":"input"}),
    input = $("<textarea />", {
      "placeholder":"Inserta el párrafo",
      "class":"parrafo"
    });

    $(label).text("Inserta el párrafo:");
    $(label).append(cerrar);
    $(label).append(br);
    $(label).append(input);

    $(".inputs").append(label);
  });
  // ->Agregar contenido


  $("#AgregarTema").on("click", function(){

    var comprobar = 0, cantidad;

    //Comprobamos cantidad de inputs vacios y agregamos clases

    var Tema = $("#Tema").val(),
        campo = $("#campo").val();

      if (Tema == "") {
        $("#Tema").addClass("inputError");
        comprobar++;
      }
      else {
        $("#Tema").removeClass("inputError");
      }
      if (campo == "") {
        $("#campo").addClass("inputError");
        comprobar++;
      }
      else {
        $("#campo").removeClass("inputError");
      }


    // Aqui se valida los elementos para crear el documento

    cantidad = $(".inputs").children();

    var contenido, tipoDeElemento, tipoDeInput, nImg, extImg, nameR, file;

    for (var i = 0; i < cantidad.length; i++) {

      tipoDeElemento = $(cantidad[i]).attr("class"),
      tipoDeInput = $(cantidad[i]).children("input, textarea").attr("class");

      if (tipoDeElemento == "addImage") {
        aidi = $(cantidad[i]).children().children().children("input").attr("id");
        var file = $("#"+aidi)[0].files[0];
        if(!file || file.type.split("/")[0] != "image"){
          $("#VentanaEspera").show();
          $("#VentanaEspera h4").text("Esto no es una imagen");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 2500);
          $("#"+aidi).css("border","2px solid #ff0000");
          comprobar++;
        }
        else {
          $("#"+aidi).css("border","none");
        }
      }
      else if (tipoDeElemento == "input") {
        contenido = $(cantidad[i]).children("input, textarea").val();

        if (contenido == "") {
          comprobar++;
          $(cantidad[i]).children("input, textarea").addClass("inputError");
        }
        else{
          $(cantidad[i]).children("input, textarea").removeClass("inputError");
        }
      }
    }
    // ->Aqui se valida los elementos para crear el documento
    if (comprobar == 0) {

    // Funciones para crear el contenido
    function crearTitulo(title){
      var cTitle = "<h2>" + title + "</h2>";
      return cTitle;
    }

    function crearImagen(nombreImg){
      var cImg = '<div class="imagen"><div class="col-sm-3 col-md-2"></div><div class="col-sm-6 col-md-8"><img src="images/' + nombreImg + '" alt="Imagen de ejemplo" /></div><div class="col-sm-3 col-md-2"></div></div>';
      return cImg;
    }

    function crearSubitulo(subtitle){
      var cSubtitle = "<h4>" + subtitle +"</h4>";
      return cSubtitle;
    }

    function crearTexto(text){
      var cText = "<p>" + text +"</p>";
      return cText;
    }
    // ->Funciones para crear el contenido

    // PARTE EXCLUSIVA PARA CREAR EL DOCUMENTO
    var CodigoHTML = ""; // <--- Variable que alamacenará el codigo HTML

    //Obtengo datos
    var cant = $(".inputs").children();

    var contenido, tipoDeElemento, tipoDeInput, nImg, extImg, nameR;

    for (var i = 0; i < cant.length; i++) {

      tipoDeElemento = $(cant[i]).attr("class"),
      tipoDeInput = $(cant[i]).children("input, textarea").attr("class");

      if (tipoDeElemento == "addImage") {
        aidi = $(cantidad[i]).children().children().children("input").attr("id");
        var file = $("#"+aidi)[0].files[0];
        var fileName = file.name;

        //
        var formData = new FormData($("#form"+ aidi)[0]),
        ruta = "php/validacionesAjax.php?tipo=comprobarImagenYSubir";
        $.ajax({
          url:ruta,
          beforeSend: function(){
            $("#VentanaEspera").show();
            $("#VentanaEspera h4").text("Estamos creando la ayuda, esto puede tardar varios minutos, ¡Anda por una taza de café mientras! Subiendo Imagenes...");
          },
          type: "POST",
          data: formData,
          async:false,
          cache:false,
          contentType: false,
          processData: false,
          success: function(res){
              CodigoHTML += crearImagen(res);
          }
        });
        //
      }
      else if (tipoDeElemento == "input") {
        contenido = $(cant[i]).children("input, textarea").val();

        if (tipoDeInput == "titulo") {
          CodigoHTML += crearTitulo(contenido);
        }

        else if (tipoDeInput == "subtitulo") {
          CodigoHTML += crearSubitulo(contenido);
        }
        else if (tipoDeInput == "parrafo") {
          CodigoHTML += crearTexto(contenido);
        }
      }
      $(cant[i]).remove();
    }
    c = 0; x = 0;

    var Nombre = $("#Tema").val(),
        Seccion = $("select").val(),
        direccion = "Tema.php?tema=" + trim($("#Tema").val());
    // ->PARTE EXCLUSIVA PARA CREAR EL DOCUMENTO

    //Obtengo los datos
    var datos = {
      "tipo":"Ayuda",
      "Nombre": Nombre,
      "url":direccion,
      "Contenido":CodigoHTML,
      "Dependencia":Seccion
    }

    $("#VentanaEspera h4").text("Estamos creando la ayuda, esto puede tardar varios minutos, ¡Anda por una taza de café mientras! Guardando...");

    $.get("php/validacionesAjax.php", datos, function(res){

      if (res == "Exito") {

    var datos = {
      "tipo":"ObtenerElemento",
      "campoASeleccionar":"id",
      "tabla":"ayuda"
    }

    $.getJSON("php/validacionesAjax.php", datos, function(res){

      if (res.Exito == "Exito") {
        $("#VentanaEspera h4").text("¡La ayuda se ha agregado exitosamente!");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 1500);
        //Creo el Tema
        var Tema = $("<a />", {"target":"_blank","href":direccion,"id":res.campo}),
            dv = $("<div />", {"class":"seccion"}),
            h5 = $("<h5 />"),
            span = $("<span />", {"class":"glyphicon glyphicon-remove pull-right EliminarPub"});

        //Asigno valores
        $(h5).text(Nombre);

        //Meto los elementos
        $(h5).append(span);
        $(dv).append(h5);
        $(Tema).append(dv);

        $(span).on("click", function(){
          $(this).attr("name", "true");
        checar();
        });


        //Lo meto al documento
        if (Seccion == "Kp") {
          if ($("#CKp").children("a").length == 0) {
            $(dv).addClass("top");
          }
          $("#CKp").append(Tema);
          checarNumPubs("CKp");
        }
        else if (Seccion == "Kj"){
          if ($("#CKj").children("a").length == 0) {
            $(dv).addClass("top");
          }
          $("#CKj").append(Tema);
          checarNumPubs("CKj");
        }
        else if (Seccion == "Cpp"){
          if ($("#Ccpp").children("a").length == 0) {
            $(dv).addClass("top");
          }
          $("#Ccpp").append(Tema);;
          checarNumPubs("Ccpp");
        }
        else if (Seccion == "Libinteractive"){
          if ($("#Lb").children("a").length == 0) {
            $(dv).addClass("top");
          }
          $("#Lb").append(Tema);
          checarNumPubs("Lb");
        }
        else if (Seccion == "Robotica"){
          if ($("#Rb").children("a").length == 0) {
            $(dv).addClass("top");
          }
          $("#Rb").append(Tema);
          checarNumPubs("Rb");
        }

        //Limpio Inputs y cierro modal

        $(".vmodal input[type='text']").val("");
        $("#nt").hide();
      }
      else {
        $("#VentanaEspera h4").text("Oops, ha surgido un error, intentalo de nuevo");
        $("#VentanaEspera img").hide();
        setTimeout(ocultarProceso, 2500);
      }
    });
      }
    });
  }
  });

});
