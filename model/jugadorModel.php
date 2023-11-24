<?php

// require './includes/conexion.php';
// require_once('./includes/conexion.php');
// if (file_exists('./includes/db.php')) {
//     require_once('./includes/db.php');
// } else {
//     require_once('../includes/db.php');
// }
require_once('../includes/db.php');
// require_once(__DIR__ . '/includes/conexion.php');
class jugadorModel extends DB
{
    public function createJugador($nombre, $apellido, $fechaNacimiento, $piernaHabil, $manoHabil, $posicion, $estado, $username, $dorsal, $posicionAlternativa, $dni_jugador)
    {
        // Validación de datos (puedes agregar más validaciones según tus necesidades)
        if (empty($nombre) || empty($apellido) || empty($fechaNacimiento) || empty($piernaHabil) || empty($manoHabil) || empty($posicion) || empty($estado) || empty($username) || empty($dorsal) || empty($posicionAlternativa) || empty($dni_jugador)) {
            // Manejo de error de datos faltantes
            return false;
        }

        // Uso de sentencia preparada para prevenir la inyección de SQL
        $query = $this->connect()->prepare("INSERT INTO jugadores (nombre, apellido, fecha_nacimiento, pierna_habil, mano_habil, posicion_alt, id_estado_fk, id_username_fk, dorsal, id_posicion_fk,dni_jugador) VALUES (:nombre, :apellido, :fechaNacimiento, :piernaHabil, :manoHabil, :posicionAlternativa, :estado, :username, :dorsal, :posicion, :dni_jugador)");

        $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $query->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
        $query->bindParam(':piernaHabil', $piernaHabil, PDO::PARAM_INT);
        $query->bindParam(':manoHabil', $manoHabil, PDO::PARAM_INT);
        $query->bindParam(':posicion', $posicion, PDO::PARAM_INT);
        $query->bindParam(':estado', $estado, PDO::PARAM_INT);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':dorsal', $dorsal, PDO::PARAM_INT);
        $query->bindParam(':posicionAlternativa', $posicionAlternativa, PDO::PARAM_STR);
        $query->bindParam(':dni_jugador', $dni_jugador, PDO::PARAM_INT);

        // Ejecución de la sentencia preparada
        if ($query->execute()) {
            $query = $this->connect()->query("SELECT MAX(id_jugador) FROM jugadores");
            $lastInsertId = $query->fetchColumn();
            return $lastInsertId;
        } else {
            // Manejo de error en la ejecución de la sentencia
            return false;
        }
    }

    // Función para leer todos los jugadores
    public function ConsultarJugadores()
    {
        $query = $this->connect()->query("SELECT j.id_jugador,j.nombre as nombre_jugador,j.dni_jugador
            ,j.apellido as apellido_jugador,j.dorsal,j.fecha_nacimiento, j.mano_habil,
            j.pierna_habil,pos.nombre_posicion,ej.d_dato as estado, pos_alt.nombre_posicion as pos_alt
            from jugadores j inner join estado_jugador ej on j.id_estado_fk = ej.id_estado_jug 
            INNER JOIN posicion pos on j.id_posicion_fk = pos.id_posicion
            INNER JOIN posicion AS pos_alt ON j.posicion_alt = pos_alt.id_posicion");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para obtener un jugador por su ID
    public function consultarJugadorById($id)
    {
        $query = $this->connect()->prepare("SELECT j.nombre as nombre_jugador,j.dni_jugador,
            j.apellido as apellido_jugador,j.dorsal,j.fecha_nacimiento, j.mano_habil,
            j.pierna_habil,pos.nombre_posicion,ej.d_dato as estado, pos_alt.nombre_posicion as pos_alt
            from jugadores j inner join estado_jugador ej on j.id_estado_fk = ej.id_estado_jug 
            INNER JOIN posicion pos on j.id_posicion_fk = pos.id_posicion
            INNER JOIN posicion AS pos_alt ON j.posicion_alt = pos_alt.id_posicion
            WHERE id_jugador = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function consultarPosicion()
    {
        $query = $this->connect()->query("SELECT id_posicion,nombre_posicion FROM posicion");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarEstado()
    {
        $query = $this->connect()->query("SELECT id_estado_jug, d_dato FROM estado_jugador");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Función para actualizar un jugador
    public function updateJugador($id_jugador, $nombre, $apellido, $fecha_nacimiento, $pierna_habil, $mano_habil, $posicion, $estado, $username, $dorsal, $posicionAlternativa)
    {
        try {


            $query = "UPDATE jugadores SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento, pierna_habil = :pierna_habil, mano_habil = :mano_habil, posicion = :posicion, estado = :estado, username = :username, dorsal = :dorsal, posicion_alternativa = :posicion_alternativa WHERE id_jugador = :id_jugador";

            $query = $this->connect()->prepare($query);

            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $query->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $query->bindParam(':fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
            $query->bindParam(':piernaHabil', $piernaHabil, PDO::PARAM_INT);
            $query->bindParam(':manoHabil', $manoHabil, PDO::PARAM_INT);
            $query->bindParam(':posicion', $posicion, PDO::PARAM_INT);
            $query->bindParam(':estado', $estado, PDO::PARAM_INT);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':dorsal', $dorsal, PDO::PARAM_INT);
            $query->bindParam(':posicionAlternativa', $posicionAlternativa, PDO::PARAM_STR);
            $query->bindParam(':id_jugador', $id_jugador);

            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Manejo de errores
            return false;
        }
    }

    // Función para eliminar un jugador por su ID
    public function eliminarJugador($id_jugador)
    {
        try {
            $query = "DELETE FROM jugadores WHERE id_jugador = :id_jugador";
            $query = $this->connect()->prepare($query);
            $query->bindParam(':id_jugador', $id_jugador, PDO::PARAM_INT);

            if ($query->execute()) {
                return true; // Éxito al eliminar el jugador.
            } else {
                return false; // Error al eliminar el jugador.
            }
        } catch (PDOException $e) {
            // Manejo de errores, por ejemplo, registro de errores.
            return false;
        }
    }

    public function getUserXJugador($user)
    {
        $query = $this->connect()->prepare('SELECT j.id_jugador,j.nombre,j.apellido FROM usuarios u INNER JOIN jugadores j
        on u.username = j.id_username_fk
        WHERE username = :user');
        $query->execute(['user' => $user]);
        // $userRow = $query->fetch(PDO::FETCH_ASSOC);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
