export default function generar_cuenta_corriente(
  username,
  username_sistem,
  id_jugador
) {
  const fechaInscripcion = new Date(); // Debes ajustar esto con la fecha de inscripción real

  const fechaDiciembre = new Date(fechaInscripcion.getFullYear(), 11, 31); // 11 es el índice de diciembre

  const num_cuota_meses =
    fechaDiciembre.getMonth() - fechaInscripcion.getMonth() + 1;

  var data = {
    accion: "register",
    num_cuota_meses: num_cuota_meses,
    username: username,
    username_sistem: username_sistem,
    id_jugador_fk: id_jugador,
  };

  $.ajax({
    url: "../controller/cuentaCteController.php", // Ruta al controlador PHP que manejará la acción
    type: "POST", // Cambia el tipo de solicitud a POST
    data: data, // Envía los datos al servidor
    dataType: "json",
    success: function (data) {
      Swal.fire({
        title: "Jugador y cuenta corriente creado con exito!.",
        icon: "success",
        showConfirmButton: true,
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
}
