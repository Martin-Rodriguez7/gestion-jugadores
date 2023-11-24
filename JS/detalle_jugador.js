setTimeout(function () {
  $("#title_page").addClass("mostrando");
  $("#card_animation").addClass("card_animation_start");
}, 2);

if (cant_jugadores > 1) {
  $("#s_jugadores").removeClass("d-none");
} else {
}

obtenerDatosJugador(id_jugador);
obtenerCuotas(id_jugador);
jugadoresXuser(username_sistem);
var id_jugador_select;
$("#name_jugador").on("change", function () {
  id_jugador_select = $(this).val();
  obtenerDatosJugador(id_jugador_select);
  obtenerCuotas(id_jugador_select);
});

function obtenerDatosJugador(id_jugador) {
  var data = {
    accion: "consultarxid",
    id_jugador: id_jugador, // Define la acción que deseas realizar en el servidor
  };
  $.ajax({
    url: "../controller/jugadorController.php", // Ruta al controlador PHP que manejará la acción
    type: "POST", // Cambia el tipo de solicitud a POST
    data: data, // Envía los datos al servidor
    dataType: "json",
    success: function (data) {
      // Aquí procesa los datos recibidos y crea las tarjetas en el HTML
      console.log(data);
      // Formatea la fecha
      var fechaNacimiento = new Date(data.fecha_nacimiento);
      var fechaFormateada = fechaNacimiento.toLocaleDateString();

      $("#id_nombre_apellido").text(
        data.nombre_jugador.toUpperCase() +
          " " +
          data.apellido_jugador.toUpperCase()
      );
      $("#id_categoria").text("Categoria: 1999");
      $("#id_posicion").text("Posicion: " + data.nombre_posicion);
      $("#id_posicion_alt").text("Posicion Alternativa: " + data.pos_alt);
      $("#id_dorsal").text("Dorsal " + data.dorsal);
      $("#id_fecha_nacimiento").text("Fecha de nacimiento: " + fechaFormateada);
      $("#id_mano_habil").text("Mano Habil: " + data.mano_habil);
      $("#id_pierna_habil").text("Pierna Habil: " + data.pierna_habil);
    },
    error: function (xhr, status, error) {
      // Manejar errores de AJAX aquí
      console.log(error);
    },
  });
}

function obtenerCuotas(id_jugador) {
  var data_cuotas = {
    accion: "consultar_cuotas_jugador",
    id_jugador_fk: id_jugador, // Define la acción que deseas realizar en el servidor
  };

  $.ajax({
    url: "../controller/cuentaCteController.php",
    type: "POST",
    data: data_cuotas,
    dataType: "json",
    success: function (cuota_jugador) {
      // Formatea la fecha
      let num_cuotas = 1;
      console.log(cuota_jugador);
      // var fechaNacimiento = new Date(data.fecha_nacimiento);
      // var fechaFormateada = fechaNacimiento.toLocaleDateString();
      $("#data_player").empty();
      cuota_jugador.forEach(function (cuota_jugador) {
        var rowHtml = "<tr>";
        rowHtml += "<td>" + num_cuotas + "</td>";
        rowHtml += "<td>" + cuota_jugador.cuotas_mes + "</td>";
        // rowHtml += '<td>' + fechaFormateada + '</td>';
        rowHtml += "<td>" + cuota_jugador.f_vto + "</td>";
        rowHtml += "<td>" + cuota_jugador.imp_cuota + "</td>";
        // rowHtml += "<td>" + cuota_jugador.saldo_afavor + "</td>";
        rowHtml += "<td>" + cuota_jugador.estado_cuota + "</td>";
        // rowHtml += "<td>" + cuota_jugador.estado + "</td>";
        rowHtml +=
          '<td><button data-bs-toggle="modal" data-bs-target="#confirmPago" class="btn btn-primary btn-pagar shadow-sm text-black rounded-3" data-id="' +
          cuota_jugador.id_detalle +
          '" >Pagar</button></td>';
        // Agrega más columnas según los datos que desees mostrar en la tabla
        rowHtml += "</tr>";
        console.log("gola");
        $("#data_player").append(rowHtml);
        num_cuotas++;
      });
    },
    error: function (xhr, status, error) {
      // Manejar errores de AJAX aquí
      console.log(error);
    },
  });
}

$("#data_player").on("click", ".btn-pagar", function () {
  var cuotaId = $(this).data("id");
  var data_pago = {
    accion: "realizar_pago",
    cuotaId: cuotaId, // Define la acción que deseas realizar en el servidor
  };

  $("#btnPagar").click(function () {
    $.ajax({
      url: "../controller/cuentaCteController.php", // Ruta al controlador PHP que manejará la acción
      type: "POST", // Cambia el tipo de solicitud a POST
      data: data_pago, // Envía los datos al servidor
      dataType: "json",
      success: function (data) {
        Swal.fire({
          title: "Cuota pagada con exito!",
          icon: "success",
          showConfirmButton: true,
        });
        obtenerCuotas(id_jugador_select);
        $("#confirmPago").modal("hide");
      },
      error: function (xhr, status, error) {
        var jsonResponse = JSON.parse(xhr.responseText);
        Swal.fire({
          title: jsonResponse.message,
          icon: "error",
          showConfirmButton: true,
        });
      },
    });
  });
  // Lógica para manejar el pago según el ID de la cuota
  // Puedes realizar una solicitud AJAX para procesar el pago aquí
  // por ejemplo, redireccionar a una página de pago, abrir un modal, etc.
  console.log("Pagar cuota con ID: " + cuotaId);
});
function jugadoresXuser(username_sistem) {
  var data_player = {
    accion: "consultar_jxu",
    user: username_sistem, // Define la acción que deseas realizar en el servidor
  };

  $.ajax({
    url: "../controller/jugadorController.php", // Ruta al controlador PHP que manejará la acción
    type: "POST", // Cambia el tipo de solicitud a POST
    data: data_player,
    dataType: "json",
    success: function (data) {
      $("#name_jugador").empty();
      // Llena los select con los datos recibidos
      data.forEach(function (jugadores) {
        $("#name_jugador").append(
          $("<option>", {
            value: jugadores.id_jugador,
            text: jugadores.nombre,
          })
        );
      });
    },
  });
}
