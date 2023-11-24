<?php
// Incluye el modelo JugadorModel
include('../model/jugadorModel.php');  // Asegúrate de que el archivo tenga la ruta correcta

// Datos recibidos del formulario
$accion = $_POST['accion'];

// Instancia el modelo JugadorModel
$model = new jugadorModel();  // Asegúrate de que $db esté configurado correctamente

switch ($accion) {
    case 'alta_jugador':
        try {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fecha_nacimiento = $_POST['fechaNacimiento'];
            $pierna_habil = $_POST['piernaHabil'];
            $mano_habil = $_POST['manoHabil'];
            $posicion = $_POST['posicion'];
            $estado = $_POST['estado'];
            $username = $_POST['username'];
            $dorsal = $_POST['dorsal'];
            $posicionAlternativa = $_POST['posicionAlternativa'];
            $dni_jugador = $_POST['dni_jugador'];


            // Validación de datos (puedes agregar más validaciones según tus necesidades)
            // if (empty($nombre) || empty($apellido) || empty($fechaNacimiento) || empty($piernaHabil) || empty($manoHabil) || empty($posicion) || empty($estado) || empty($username) || empty($dorsal) || empty($posicionAlternativa) || empty($dni_jugador)) {
            //     throw new Exception('Faltan datos obligatorios');
            // }

            // Llama a la función para crear el jugador
            $nuevoJugadorId = $model->createJugador($nombre, $apellido, $fecha_nacimiento, $pierna_habil, $mano_habil, $posicion, $estado, $username, $dorsal, $posicionAlternativa, $dni_jugador);

            if ($nuevoJugadorId !== false) {
                echo json_encode(['status' => 'success', 'message' => 'Jugador creado con éxito', 'id_jugador' => $nuevoJugadorId]);
            } else {
                throw new Exception('Error al crear el jugador');
            }
        } catch (PDOException $e) {
            http_response_code(302);
            if ($e->errorInfo[1] == 1062) {
                // Error de clave duplicada (puede variar según la base de datos)
                echo json_encode(['status' => 'error', 'message' => 'Error: Ya existe una jugador con estos datos.'], 400);
            } else {
                // Otro tipo de error
                echo json_encode(['status' => 'error', 'message' => 'Error: Ya existe una jugador con estos datos.'], 400);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
        break;

    case 'actualizar_jugador':
        try {
            $id_jugador = $_POST['id_jugador'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fecha_nacimiento = $_POST['fechaNacimiento'];
            $pierna_habil = $_POST['piernaHabil'];
            $mano_habil = $_POST['manoHabil'];
            $posicion = $_POST['posicion'];
            $estado = $_POST['estado'];
            $username = $_POST['username'];
            $dorsal = $_POST['dorsal'];
            $posicionAlternativa = $_POST['posicionAlternativa'];

            // Validación de datos
            if (empty($id_jugador) || empty($nombre) || empty($apellido) || empty($fecha_nacimiento) || empty($pierna_habil) || empty($mano_habil) || empty($posicion) || empty($estado) || empty($username) || empty($dorsal)) {
                throw new Exception('Faltan datos obligatorios');
            }

            // Llama a la función para actualizar el jugador
            $result = $model->updateJugador($id_jugador, $nombre, $apellido, $fecha_nacimiento, $pierna_habil, $mano_habil, $posicion, $estado, $username, $dorsal, $posicionAlternativa);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Jugador actualizado con éxito']);
            } else {
                throw new Exception('Error al actualizar el jugador');
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;
    case 'eliminar':
        $id = $_POST['id_jugador'];
        $eliminacionExitosa = $model->eliminarJugador($id);
        // Puedes enviar una respuesta JSON con un mensaje de éxito/error
        echo json_encode(['message' => $eliminacionExitosa ? 'Jugador eliminado con éxito' : 'Error al eliminar jugador']);
        break;

    case 'consultar':
        $jugadores = $model->ConsultarJugadores();
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($jugadores);
        break;
    case 'consultarxid':
        $id = $_POST['id_jugador'];
        $jugadores = $model->consultarJugadorById($id);
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($jugadores);
        break;
    case 'consultar_posicion':

        $jugadoresPos = $model->consultarPosicion();
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($jugadoresPos);
        break;
    case 'consultar_estados':

        $jugadoresEst = $model->consultarEstado();
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($jugadoresEst);
        break;
    case 'consultar_jxu':
        $username = $_POST['user'];
        $jugadores = $model->getUserXJugador($username);
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($jugadores);
        break;

    default:
        // Manejo de acción no válida
        echo json_encode(['message' => 'Acción no válida']);
        break;
}
