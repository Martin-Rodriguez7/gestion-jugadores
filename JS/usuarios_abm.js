/*HACER GIRAR LA IMAGEN DE ALTA USUARIO */
$("#add-user-img").click((e) => {
  $("#add-user-img").addClass("circleAnimation");
  setTimeout(() => {
    $("#add-user-img").removeClass("circleAnimation");
  }, 500);
});

setTimeout(function () {
  $("#title_page").addClass("mostrando");
  $("#card_animation").addClass("card_animation_start");
}, 2); // Agrega la clase después de 5 segundos (5000 milisegundos)
consultarUsuarios();

$("#register_form").submit(function (e) {
  e.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

  // Obtiene los datos del formulario
  var nombre_completo = $("#nombre_completo").val();
  var email = $("#email").val();
  var username = $("#username").val();
  var dni_user = $("#dni_user").val();
  var password = $("#password").val();
  var estado = $("#estado").val();
  var tipo_us = $("#tipo_us").val();

  // Crea un objeto con los datos a enviar al servidor
  var userData = {
    accion: "register",
    nombre_completo: nombre_completo,
    email: email,
    username: username,
    dni_user: dni_user,
    password: password,
    estado: estado,
    tipo_us: tipo_us,
  };

  $.ajax({
    url: "../controller/UserController.php",
    type: "POST",
    data: userData, // Envía los datos al servidor
    dataType: "json",
    success: function (data) {
      $("#register_form")[0].reset();

      Swal.fire({
        title: "¡Usuario registrado correctamente",
        icon: "success",
        showConfirmButton: false,
        timer: 1000,
      });
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

function consultarUsuarios() {
  var data = {
    accion: "consultar_usuarios",
  };

  $.ajax({
    url: "../controller/userController.php",
    type: "POST",
    data: data,
    dataType: "json",
    success: function (data_user) {
      // Formatea la fecha
      // var fechaNacimiento = new Date(data.fecha_nacimiento);
      // var fechaFormateada = fechaNacimiento.toLocaleDateString();
      data_user.forEach(function (data_user) {
        // Crea una fila de tabla para cada jugador
        var rowHtml = "<tr>";
        rowHtml += "<td>" + data_user.nombre_apellido + "</td>";
        // rowHtml += '<td>' + fechaFormateada + '</td>';
        rowHtml += "<td>" + data_user.email + "</td>";
        rowHtml += "<td>" + data_user.dni + "</td>";
        rowHtml += "<td>" + data_user.username + "</td>";
        rowHtml += "<td>" + data_user.tipous + "</td>";
        rowHtml += "<td>" + data_user.estado + "</td>";
        // Agrega más columnas según los datos que desees mostrar en la tabla
        rowHtml += "</tr>";

        $("#data_user").append(rowHtml);
      });
    },
    error: function (xhr, status, error) {
      // Manejar errores de AJAX aquí
      console.log(error);
    },
  });
}
