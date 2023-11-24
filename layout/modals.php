<div class="modal fade" id="cargarJugadorModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="cargarJugadorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content rounded-2 p-3 ">
            <div class="row">
                <div id="form_new_player" class="col shadow rounded-3 pt-3">
                    <form id='cargarJugadorForm' class="pt-1 shadow-sm ps-2 pe-2" method="POST">
                        <div class="modal-body">
                            <h3 id="title_player" class="fw-bold shadow-sm rounded-3 me-2 ms-2 mb-2 p-2 text-center">Nuevo Jugador</h3>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class="error-message" id="errorNombre"></span>
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_jugador" name="nombre_jugador" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class="error-message" id="errorApellido"></span>
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="apellido_jugador" name="apellido" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <span class="error-message" id="errorFecha"></span>
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nac.</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento_jugador" name="fecha_nacimiento" format="YYYY-MM-DD" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="pierna_habil" class="form-label">Pierna Hábil</label>
                                        <select class="form-select" id="pierna_habil" name="pierna_habil" required>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Derecha">Derecha</option>

                                        </select>
                                        <!-- <input type="text" class="form-control" id="pierna_habil" name="pierna_habil" required> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="mano_habil" class="form-label">Mano Hábil</label>
                                        <select class="form-select" id="mano_habil" name="mano_habil" required>
                                            <option value="Izquierda">Izquierda</option>
                                            <option value="Derecha">Derecha</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" id="mano_habil" name="mano_habil" required> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="posicion" class="form-label">Posición</label>
                                        <select class="form-select" id="posicion" name="posicion" required>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <select class="form-select" id="estado" name="estado" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="posicion_alternativa" class="form-label">Posición Alter.</label>
                                        <select class="form-select" id="posicion_alternativa" name="posicion_alternativa">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="dorsal" class="form-label">Dorsal (1-25)</label>
                                        <input type="number" class="form-control" id="dorsal" name="dorsal" min="1" max="25" required>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="error-message" id="errorDNI"></span>

                                    <label for="dorsal" class="form-label">DNI Jugador</label>
                                    <input type="number" class="form-control" id="dni_jugador" name="dni_jugador" required>
                                </div>
                                <div class="col-md-6 p-3 shadow-sm rounded-4">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col pt-2">
                                                <label for="fecha_nacimiento" class="form-label fw-bold">Usuario existente</label>
                                                <select class="form-select" id="id_usuario_exist" name="id_usuario_exist">
                                                </select>

                                            </div>
                                            <div class="col ms-2 pt-2">
                                                <label for="id_new_user" class="form-label fw-bold">Crear usuario</label>

                                                <button type="button" onclick="cambiarDiv()" class="btn btn-secondary shadow-sm rounded-3" id="id_new_user">Nuevo usuario</button>

                                            </div>
                                        </div>
                                        <!-- <input type="text" class="form-control" id="username" name="username" required> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cargar Jugador</button>
                        </div>
                    </form>

                </div>
                <div id="form_new_user" class="col shadow rounded-3 d-none">
                    <form id="register_form" method="POST" class="m-3 pt-1 shadow-sm p-3">
                        <h3 id="title_user" class="fw-bold shadow-sm rounded-3 me-2 ms-2 mb-2 p-2 text-center">Nuevo Usuario</h3>

                        <div class="row pt-3">
                            <div class="col-md-4 mb-4">
                                <label for="email" class="form-label fw-bolder">Correo electonico</label>
                                <input type="email" id="email" class="form-control p-2" name="email" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="nombre_completo" class="form-label fw-bolder">Nombre completo</label>
                                <input type="text" id="nombre_completo" class="form-control p-2" name="nombre_completo" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="username" class="form-label fw-bolder">Username</label>
                                <input type="text" id="username" class="form-control p-2" name="username" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="dni_user" class="form-label fw-bolder">DNI</label>
                                <input type="number" id="dni_user" class="form-control p-2" name="dni_user" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="password" class="form-label fw-bolder">Contraseña</label>
                                <input type="password" id="password" class="form-control p-2" name="password" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="password_confir" class="form-label fw-bolder">Confirmar contraseña</label>
                                <input type="password_confir" class="form-control p-2" name="password_confir" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="tipo_us" class="form-label">Tipo de usuario</label>
                                <select class="form-select" id="tipo_us" name="tipo_us" required>
                                    <option value="1">Admin</option>
                                    <option value="2">Empleado</option>
                                    <option value="3">Usuario</option>
                                </select>
                            </div>

                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary p-2 fs-4 rounded-4 text-white text-center shadow-sm pb-2">Guardar</button>
                            <button type="button" onclick="cambiarDiv()" class="btn btn-primary rounded-4 shadow-sm" id="id_new_player">Volver</button>

                        </div>

                    </form>
                </div>


            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="confirmPago" tabindex="-1" data-bs-backdrop="static" aria-labelledby="confirmPago" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea realizar el pago?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary rounded-3" id="btnPagar" data-bs-dismiss="modal">
                    Pagar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#register_form").submit(function(e) {
        setTimeout(function() {
            cambiarDiv();
            cargarSelectUser()
        }, 1000)
    });

    function cargarSelectUser() {
        var dataPos = {
            accion: "consultar_user_jugador", // Define la acción que deseas realizar en el servidor
        };

        $.ajax({
            url: "../controller/userController.php", // Ruta al controlador PHP que manejará la acción
            type: "POST", // Cambia el tipo de solicitud a POST
            data: dataPos,
            dataType: "json",
            success: function(data) {
                $("#id_usuario_exist").empty();
                // Llena los select con los datos recibidos
                data.forEach(function(usuario) {
                    $("#id_usuario_exist").append(
                        $("<option>", {
                            value: usuario.id_usuario,
                            text: usuario.username,
                        })
                    );
                });
            },
        });
    }

    function cambiarDiv() {

        var div_player = $("#form_new_player");
        var div_user = $("#form_new_user");

        div_player.toggleClass("d-none");
        div_user.toggleClass("d-none");
    }
</script>