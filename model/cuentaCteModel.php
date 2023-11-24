<?php

// require './includes/conexion.php';
// require_once('./includes/conexion.php');
if (file_exists('./includes/db.php')) {
    require_once('./includes/db.php');
} else {
    require_once('../includes/db.php');
}
// require_once(__DIR__ . '/includes/conexion.php');
class CuentaCteModel extends DB

{
    public function GenerarCuenta($username, $estado)
    {
        // Verificar si el usuario ya tiene una cuenta corriente
        $id_cuenta_existente = $this->ObtenerIdCuentaExistente($username);


        if ($id_cuenta_existente !== false) {

            return $id_cuenta_existente;
        }


        $query = $this->connect()->prepare("SELECT dni FROM usuarios WHERE username = :username");
        // Valor que deseas enlazar a la consulta preparada
        $username_query = $username;
        // Enlazar el valor a la consulta preparada
        $query->bindParam(':username', $username_query);
        $query->execute();
        // Almacenar el valor de la columna en una variable
        $dni_user = $query->fetchColumn();

        $query = $this->connect()->prepare("INSERT INTO cuentacte 
        (estado,dni,username)
         VALUES (:estado, :dni,:username)");

        $query->bindParam(':estado', $estado, PDO::PARAM_STR);
        $query->bindParam(':dni', $dni_user, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        if ($query->execute()) {
            // return $this->connect()->lastInsertId();
            $query = $this->connect()->query("SELECT MAX(id_cta_cte) FROM cuentacte");
            $lastInsertId = $query->fetchColumn();
            return $lastInsertId;
        } else {
            // Manejo de error en la ejecución de la sentencia
            return false;
        }
    }

    public function
    GenerarCuota($cuentaCteId, $f_vto, $imp_cuota, $saldo_afavor, $id_estado_det_cta_cte, $fechames, $id_jugador)
    {
        $query = $this->connect()->prepare("INSERT INTO detallectacte 
        (id_cta_cte, f_vto, imp_cuota, saldo_afavor, id_estado_det_cta_cte,cuotas_mes,id_jugador_fk)
         VALUES (:id_cta_cte, :f_vto, :imp_cuota, :saldo_afavor, :id_estado_det_cta_cte,:cuotas_mes,:id_jugador_fk)");

        $query->bindParam(':id_cta_cte', $cuentaCteId, PDO::PARAM_STR);
        $query->bindParam(':f_vto', $f_vto, PDO::PARAM_STR);
        $query->bindParam(':imp_cuota', $imp_cuota, PDO::PARAM_INT);
        $query->bindParam(':saldo_afavor', $saldo_afavor, PDO::PARAM_INT);
        $query->bindParam(':id_estado_det_cta_cte', $id_estado_det_cta_cte, PDO::PARAM_INT);
        $query->bindParam(':cuotas_mes', $fechames, PDO::PARAM_STR);
        $query->bindParam(':id_jugador_fk', $id_jugador, PDO::PARAM_INT);

        if ($query->execute()) {
            return true;
        } else {
            // Manejo de error en la ejecución de la sentencia
            return false;
        }
    }

    public function ObtenerIdCuentaExistente($username)
    {
        // Consulta para obtener el id_cuenta_cte si el usuario ya tiene una cuenta corriente
        $query = $this->connect()->prepare("SELECT id_cta_cte FROM cuentacte WHERE username = :username");

        // Enlazar el valor a la consulta preparada
        $query->bindParam(':username', $username, PDO::PARAM_STR);

        // Ejecutar la consulta
        $query->execute();

        // Obtener el id_cuenta_cte si existe, de lo contrario, devolver false
        return $query->fetchColumn() ?: false;
    }
    public function PagarCuota($id_detalle)
    {

        $id_estado = 1;
        $query = $this->connect()->prepare("UPDATE detallectacte SET id_estado_det_cta_cte = :id_estado_det_cta_cte WHERE id_detalle = :id_detalle");

        // Enlazar el valor a la consulta preparada
        $query->bindParam(':id_estado_det_cta_cte', $id_estado, PDO::PARAM_INT);
        $query->bindParam(':id_detalle', $id_detalle, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($query->execute()) {
            return true;
        } else {

            return false;
        }
    }
    public function ObtenerDatosDetallesCuenta($id_jugador)
    {
        try {
            // Consulta SQL con INNER JOIN
            $sql = "SELECT det_cta.id_detalle,c_ctate.id_cta_cte, det_cta.imp_cuota, det_cta.f_vto,  det_cta.cuotas_mes,det_cta.saldo_afavor, est_det_cta.d_dato as estado_cuota
                FROM detallectacte det_cta inner join cuentacte c_ctate on c_ctate.id_cta_cte = det_cta.id_cta_cte
                INNER JOIN estado_cta_cte est_det_cta ON det_cta.id_estado_det_cta_cte = est_det_cta.id_estado_cta
                INNER JOIN jugadores j on j.id_jugador = det_cta.id_jugador_fk 
                where det_cta.id_jugador_fk = :id_jugador";

            // Preparar la consulta
            $query = $this->connect()->prepare($sql);

            // Enlazar el valor a la consulta preparada
            $query->bindParam(':id_jugador', $id_jugador, PDO::PARAM_INT);

            // Ejecutar la consulta
            $query->execute();

            // Obtener y devolver los resultados
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar errores de la conexión o la consulta
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
