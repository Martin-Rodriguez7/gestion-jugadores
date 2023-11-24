<?php

// require './includes/conexion.php';
// require_once('./includes/conexion.php');
if (file_exists('./includes/db.php')) {
    require_once('./includes/db.php');
} else {
    require_once('../includes/db.php');
}
// require_once(__DIR__ . '/includes/conexion.php');
class userModel extends DB
{
    private $nombre;
    private $username;


    // public function userExistss($user, $pass){
    //     $md5pass = md5($pass);
    //     $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
    //     $query->execute(['user' => $user, 'pass' => $md5pass]);

    //     if($query->rowCount()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    public function userExists($user, $pass)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);

        if ($query->rowCount()) {
            $userRow = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($pass, $userRow['clave'])) {
                // Autenticación exitosa
                return array(
                    'authenticated' => true,
                    'rol' => $userRow['id_tipo_us']
                );
            } else {
                // Contraseña incorrecta
                return array(
                    'authenticated' => false,
                    'rol' => null
                );
            }
            return password_verify($pass, $userRow['clave']);
        } else {
            return false;
        }
    }
    public function ConsultarUsuarios()
    {
        $query = $this->connect()->query("SELECT u.nombre_apellido,u.email,u.dni,u.username,tip.descripcion as tipous,es.d_dato as estado from usuarios u inner join estado es on u.id_estado = es.id_estado 
        inner join tipous tip on u.id_tipo_us = tip.id_tipous");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ConsultarUsuariosJugador()
    {
        $tipous = 3;
        $query = $this->connect()->prepare("SELECT u.nombre_apellido,u.email,u.dni,u.username,tip.descripcion as tipous,es.d_dato as estado from usuarios u inner join estado es on u.id_estado = es.id_estado 
        inner join tipous tip on u.id_tipo_us = tip.id_tipous
        where tip.id_tipous = :tipo_us");
        $query->bindParam(':tipo_us', $tipous, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function registerUser($nombre_completo, $username, $password, $email, $estado, $tipo_us, $dni_user)
    {

        // Hash seguro de contraseña
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        // Uso de sentencia preparada para prevenir la inyección de SQL
        $query = $this->connect()->prepare("INSERT INTO usuarios (nombre_apellido, username, clave, email, id_estado, id_tipo_us, dni) VALUES (:nombre_completo, :username, :password, :email, :estado, :tipo_us, :dni_user)");

        $query->bindParam(':nombre_completo', $nombre_completo, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $hashedPass, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':estado', $estado, PDO::PARAM_INT);
        $query->bindParam(':tipo_us', $tipo_us, PDO::PARAM_INT);
        $query->bindParam(':dni_user', $dni_user, PDO::PARAM_STR);

        // Ejecución de la sentencia preparada
        if ($query->execute()) {
            return $this->connect()->lastInsertId();
        } else {
            // Manejo de error en la ejecución de la sentencia
            return false;
        }
    }

    public function setUser($user)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);
        $userRow = $query->fetch(PDO::FETCH_ASSOC);
        $this->nombre = $userRow['nombre_apellido'];

        $this->username = $userRow['username'];
        // foreach ($userRow as $currentUser) {
        //     echo var_dump( $userRow['username']);
        //     $this->nombre = $userRow['username'];
        //     echo var_dump($currentUser['username']);
        //     $this->username = $currentUser['username'];
        // }
    }
    public function getUserXJugador($user)
    {
        $query = $this->connect()->prepare('SELECT j.id_jugador FROM usuarios u INNER JOIN jugadores j
        on u.username = j.id_username_fk
        WHERE username = :user');
        $query->execute(['user' => $user]);
        // $userRow = $query->fetch(PDO::FETCH_ASSOC);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNombre()
    {

        return $this->nombre;
    }
}
