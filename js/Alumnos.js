$(document).on("ready", function(){

  function Pu(){
  //  sp();
    //Creo el input
    if($(".OMI input[type='text']").length == 0){
    var input = $("<input />", {
      "type":"text",
      "class":"PuntuacionI",
      "id": "punt"
    });
    //Lo meto a donde corresponde
    $(input).insertBefore(this);
    $(".Listo").css({
      "display":"block",
      "z-index":"10000"
    });
    $(this).remove();
  }
  }

  function sp(){
      var valor = $("#punt").val();

      if (valor == "") {
        $("#punt").attr("placeholder","Por favor rellene el campo...");
        $("input[type='text']").click();
      }
      else {
        $("#punt").attr("placeholder","");

        var Name = $("#punt").parent().parent().children(".username").children().text();


      var datos = {
        "tipo":"actualizarRankAlumnos",
        "usuario": Name,
        "valor": valor
      }

      $("#VentanaEspera").show();
      $("#VentanaEspera h4").text("Actualizando...");

      $.get("php/validacionesAjax.php", datos, function(res){
        if (res == "Exito") {
          //Creo el span
          var span = $("<span />", {"class":"Puntuacion claseAdmin"});
          $(span).text(valor);

          $(span).insertBefore($("input"));

          $("#VentanaEspera h4").text("¡Listo!");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 1500);
          $("#punt").remove();
          $(span).on("click", Pu);
          $(".Listo").hide();
        }
        else{
          $("#VentanaEspera h4").text("Oops, algo salio mal, intentelo de nuevo");
          $("#VentanaEspera img").hide();
          setTimeout(ocultarProceso, 2500);
        }
      });
      }
  }

  $(".claseAdmin").on("click", Pu);
  $("#Listo").on("click", sp);
});
