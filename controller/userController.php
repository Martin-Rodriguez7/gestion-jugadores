<?php
include '../bd/conexion.php';
include '../model/userModel.php';

$modelo = new userModel($conn);

$accion_abm = $_POST['accion'];

switch ($accion_abm) {
    case 'register':
        try {
            $nombre_completo = $_POST['nombre_completo'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $estado = $_POST['estado'];
            $tipo_us = $_POST['tipo_us'];
            $dni_user = $_POST['dni_user'];

            if (empty($nombre_completo) || empty($username) || empty($password) || empty($email) || empty($estado) || empty($tipo_us) || empty($dni_user)) {
                throw new Exception('Faltan datos obligatorios');
            }
            $nuevoUserId = $modelo->registerUser($nombre_completo, $username, $password, $email, $estado, $tipo_us, $dni_user);

            if ($nuevoUserId !== false) {
                echo json_encode(['status' => 'success', 'message' => 'Usuario creado con éxito', 'id' => $nuevoUserId]);
            } else {
                throw new Exception('Error al crear el usuario');
            }
        } catch (PDOException $e) {
            http_response_code(302);
            if ($e->errorInfo[1] == 1062) {
                // Error de clave duplicada (puede variar según la base de datos)
                echo json_encode(['status' => 'error', 'message' => 'Error: Ya existe una cuenta con estos datos.']);
            } else {
                // Otro tipo de error
                echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;
    case 'consultar_usuarios':
        $usuarios = $modelo->ConsultarUsuarios();
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($usuarios);

        break;
    case 'consultar_user_jugador':
        $usuariosJugador = $modelo->ConsultarUsuariosJugador();
        // Puedes enviar una respuesta JSON con la lista de jugadores
        echo json_encode($usuariosJugador);

        break;
    default:
        // Manejo de acción no válida
        echo json_encode(['message' => 'Acción no válida']);
        break;
}
