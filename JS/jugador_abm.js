import generar_cuenta_corriente from "./cuenta_cte.js";

$(document).ready(function () {
  cargarJugadores();
  animated_title();
  function animated_title() {
    setTimeout(function () {
      $("#title_page").addClass("mostrando");
      $("#card_animation").addClass("card_animation_start");
    }, 2); // Agrega la clase después de 5 segundos (5000 milisegundos)
  }

  $("#cargarJugadorForm").submit(function (e) {
    e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

    // Obtiene los datos del formulario
    var nombre = $("#nombre_jugador").val();
    var apellido = $("#apellido_jugador").val();
    var fechaNacimiento = $("#fecha_nacimiento_jugador").val();
    var piernaHabil = $("#pierna_habil").val();
    var manoHabil = $("#mano_habil").val();
    var posicion = $("#posicion").val();
    var estado = $("#estado").val();
    var username = $("#id_usuario_exist").val();
    var dorsal = $("#dorsal").val();
    var posicionAlternativa = $("#posicion_alternativa").val();
    var dni_jugador = $("#dni_jugador").val();

    let dni = dni_jugador.replace(/\D/g, "");

    if (!/^[A-Za-z]+$/.test(nombre)) {
      $("#errorNombre").text("solo puede contener letras");
      $("#errorNombre").addClass("error-message");
      return;
    } else {
      $("#errorNombre").removeClass("error-message");
      $("#errorNombre").text("");
    }

    if (!/^[A-Za-z]+$/.test(apellido)) {
      $("#errorApellido").text("solo puede contener letras");
      $("#errorApellido").addClass("error-message");
      return;
    } else {
      $("#errorApellido").removeClass("error-message");
      $("#errorApellido").text("");
    }

    // //verificar fechas
    // let fechaNacimiento_verificar = new Date(fechaNacimiento);
    // fechaNacimiento_verificar =
    //   fechaNacimiento_verificar.toLocaleDateString("es-AR");

    // var fechaLimite = new Date("2018-12-31");
    // fechaLimite = fechaLimite.toLocaleDateString("es-AR");

    // if (fechaNacimiento_verificar <= fechaLimite) {
    //   $("#errorFecha").text("No puede ser mayor a 2018");
    //   $("#errorFecha").addClass("error-message");
    //   return;
    // } else {
    //   $("#errorNombre").removeClass("error-message");
    //   $("#errorNombre").text("");
    //   console.log(fechaNacimiento_verificar);
    //   console.log(fechaLimite);
    // }
    if (dni.length > 8) {
      $("#errorDNI").text("El DNI no puede tener más de 8 dígitos");
      $("#errorDNI").addClass("error-message");
      return;
    } else if (dni.length < 7) {
      $("#errorDNI").text("El DNI no puede tener menos de 7 dígitos");
      $("#errorDNI").addClass("error-message");
      return;
    } else {
      $("#errorDNI").removeClass("error-message");
      $("#errorDNI").text("");
    }

    if (
      nombre == "" ||
      apellido == "" ||
      fechaNacimiento == "" ||
      piernaHabil == "" ||
      manoHabil == "" ||
      posicion == "" ||
      estado == "" ||
      username == "" ||
      dorsal == "" ||
      posicionAlternativa == "" ||
      dni_jugador == ""
    ) {
      Swal.fire({
        title: "Por favor, completa todos los campos.",
        icon: "error",
        showConfirmButton: false,
        timer: 2000,
      });
    } else {
      // Crea un objeto con los datos a enviar al servidor
      var datosJugador = {
        accion: "alta_jugador",
        nombre: nombre,
        apellido: apellido,
        fechaNacimiento: fechaNacimiento,
        piernaHabil: piernaHabil,
        manoHabil: manoHabil,
        posicion: posicion,
        estado: estado,
        username: username,
        dorsal: dorsal,
        posicionAlternativa: posicionAlternativa,
        dni_jugador: dni_jugador,
      };

      // Realiza la petición POST al servidor
      $.ajax({
        type: "POST",
        url: "../controller/jugadorController.php", // Reemplaza con la URL correcta de tu controlador
        data: datosJugador,
        success: function (response) {
          var jsonResponse = JSON.parse(response);
          let id_jugador = jsonResponse.id_jugador;
          generar_cuenta_corriente(username, username_sistem, id_jugador);

          $("#cargarJugadorForm")[0].reset();
          $("#cargarJugadorModal").modal("hide");
          cargarJugadores();
        },
        error: function (xhr, status, error) {
          // Manejar errores de AJAX aquí
          var jsonResponse = JSON.parse(xhr.responseText);

          console.log("Respuesta:", jsonResponse);

          Swal.fire({
            title: jsonResponse.message,
            icon: "error",
            showConfirmButton: true,
          });
        },
      });
    }
  });

  $("#busqueda").on("input", function () {
    var terminoBusqueda = $(this).val().toUpperCase();
    $("#data").removeClass("row");
    // Oculta todas las tarjetas
    $(".card").hide();

    // Filtra las tarjetas en función del término de búsqueda
    $(".card .card-title:contains('" + terminoBusqueda + "')")
      .closest(".card")
      .show();
  });

  function cargarJugadores() {
    var data = {
      accion: "consultar", // Define la acción que deseas realizar en el servidor
    };

    $.ajax({
      url: "../controller/jugadorController.php", // Ruta al controlador PHP que manejará la acción
      type: "POST", // Cambia el tipo de solicitud a POST
      data: data, // Envía los datos al servidor
      dataType: "json",
      success: function (data) {
        $("#data").empty();
        // Aquí procesa los datos recibidos y crea las tarjetas en el HTML
        data.forEach(function (jugador_data) {
          // Formatea la fecha
          var fechaNacimiento = new Date(jugador_data.fecha_nacimiento);
          var fechaFormateada = fechaNacimiento.toLocaleDateString();

          const datosCodificados = btoa(jugador_data.id_jugador);
          // Crea las tarjetas HTML con dos columnas
          var cardHtml = '<div class="col-md-6 mb-4">'; // Dos columnas, col-md-6 para cada tarjeta
          cardHtml += '<div class="card bg-light rounded-2">';
          cardHtml += '<div class="card-body rounded-2">';
          cardHtml += '<div class="row">'; // Inicia una fila
          cardHtml += '<div class="col-md-8">'; // Divide en dos columnas
          cardHtml +=
            '<h7 class="card-title fw-bold ">' +
            jugador_data.nombre_jugador.toUpperCase() +
            " " +
            jugador_data.apellido_jugador.toUpperCase() +
            "</h7>";
          cardHtml +=
            '<p class="card-text fw-bold">DNI: ' +
            jugador_data.dni_jugador +
            "</p>";
          cardHtml +=
            '<p class="card-text fw-bold">Fecha de Nacimiento: ' +
            fechaFormateada +
            "</p>";

          cardHtml += "</div>"; // Cierra la primera columna
          cardHtml += `<a class="col-md-3 shadow-sm boton_vermas text-dark d-flex rounded-2 text-decoration-none justify-content-center align-items-center fw-bold fs-5" href="detalle_jugador.php?detalleID=${datosCodificados}">Ver mas`;
          // Divide en dos columnas y centra el contenido

          // cardHtml +=
          //   '<a class="shadow-sm rounded-2 text-center text-white text-decoration-none" href="detalle_jugador.php?id_jugador=' +
          //   tarjeta.id_jugador +
          //   '">Ver mas</a>'; // Enlace a la página de detalles del jugador
          cardHtml += "</a>"; // Cierra la segunda columna
          cardHtml += "</div>"; // Cierra la fila
          cardHtml += "</div>";
          cardHtml += "</div>";
          cardHtml += "</div>";

          $("#data").append(cardHtml);
        });
      },
      error: function (xhr, status, error) {
        // Manejar errores de AJAX aquí
        console.log(error);
      },
    });
  }
});
// Delegación de eventos para los elementos .card
$("#data").on("click", ".card", function () {
  var playerId = $(this).data("id");
  console.log("ID del Jugador:", playerId);

  // Realiza acciones específicas basadas en el ID del jugador
  // Por ejemplo, redireccionar a una página de detalles del jugador o realizar una solicitud AJAX.
});

//RELLENAR SELECT DEL MODAL
// Agrega un evento para detectar cuando se muestra el modal
$("#cargarJugadorModal").on("show.bs.modal", function (e) {
  var dataPos = {
    accion: "consultar_posicion", // Define la acción que deseas realizar en el servidor
  };
  cargarSelectUser();
  consultarEstadoJugador();
  // Realiza una petición AJAX al controlador para cargar los datos
  $.ajax({
    url: "../controller/jugadorController.php", // Ruta al controlador PHP que manejará la acción
    type: "POST", // Cambia el tipo de solicitud a POST
    data: dataPos,
    dataType: "json",
    success: function (data) {
      $("#posicion").empty();
      $("#posicion_alternativa").empty();
      // Llena los select con los datos recibidos
      data.forEach(function (posicion) {
        $("#posicion").append(
          $("<option>", {
            value: posicion.id_posicion,
            text: posicion.nombre_posicion,
          })
        );
      });
      data.forEach(function (posicion) {
        $("#posicion_alternativa").append(
          $("<option>", {
            value: posicion.id_posicion,
            text: posicion.nombre_posicion,
          })
        );
      });
    },
  });

  function consultarEstadoJugador() {
    var dataEstado = {
      accion: "consultar_estados", // Define la acción que deseas realizar en el servidor
    };
    $.ajax({
      url: "../controller/jugadorController.php", // Ruta al controlador PHP que manejará la acción
      type: "POST", // Cambia el tipo de solicitud a POST
      data: dataEstado,
      dataType: "json",
      success: function (data) {
        // Actualiza los select con los datos recibidos

        $("#estado").empty();
        data.forEach(function (estado) {
          $("#estado").append(
            $("<option>", {
              value: estado.id_estado_jug,
              text: estado.d_dato,
            })
          );
        });
      },
    });
  }
});
