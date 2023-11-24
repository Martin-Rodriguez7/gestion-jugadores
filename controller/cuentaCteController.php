<?php
include '../bd/conexion.php';
include '../model/cuentaCteModel.php';

$modelo = new CuentaCteModel();

$accion = $_POST['accion'];

switch ($accion) {
    case 'register':
        try {
            $fechaInscripcion = new DateTime();
            $fechames = new DateTime();
            $numMeses = $_POST['num_cuota_meses'];
            $estado = 1;
            $username = $_POST['username'];
            $username_sistem = $_POST['username_sistem'];
            $id_jugador = $_POST['id_jugador_fk'];
            $cuentaCteId = $modelo->GenerarCuenta($username, $estado);

            if ($cuentaCteId !== false) {
                for ($i = 1; $i <= $numMeses; $i++) {
                    $f_vto = $fechaInscripcion->modify("+1 month")->format('Y-m-d'); // Calcula la fecha de vencimiento
                    $imp_cuota = 1000;
                    $saldo_afavor = 0;
                    $id_estado_det_cta_cte = 2;
                    $fecha_mes = $fechames->format('Y-m-d');
                    $cuota = $modelo->GenerarCuota($cuentaCteId, $f_vto, $imp_cuota, $saldo_afavor, $id_estado_det_cta_cte, $fecha_mes, $id_jugador);
                    $fechames->modify("+1 month");
                    if ($cuota === false) {
                        throw new Exception('Error al crear el cuotas');
                    }
                }
            } else {
                throw new Exception('Error al crear la cuenta');
            }
            echo json_encode(['status' => 'success', 'message' => 'Cuenta creada con exito']);
        } catch (PDOException $e) {
            http_response_code(302);
            if ($e->errorInfo[1] == 1062) {
                // Error de clave duplicada (puede variar según la base de datos)
                echo json_encode(['status' => 'error', 'message' => 'Error: Ya existe una cuenta corriente con estos datos.']);
            } else {
                // Otro tipo de error
                echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;
    case 'consultar_cuotas_jugador':
        $id_jugador = $_POST['id_jugador_fk'];
        $cuotas = $modelo->ObtenerDatosDetallesCuenta($id_jugador);
        echo json_encode($cuotas);
        break;
    case 'realizar_pago':
        try {
            $cuotaid = $_POST['cuotaId'];
            $cuotas = $modelo->PagarCuota($cuotaid);
            if ($cuota === false) {
                throw new Exception('Error al pagar la cuota');
            } else {
                echo json_encode(['status' => 'success', 'message' => 'cuota pagada con exito.']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;
    default:
        // Manejo de acción no válida
        echo json_encode(['message' => 'Acción no válida']);
        break;
}
