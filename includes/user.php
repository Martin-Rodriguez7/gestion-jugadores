<!-- <?php 
// include '../includes/conexion.php';

// class userModel extends DB
// {
//     private $nombre;
//     private $username;


//     // public function userExistss($user, $pass){
//     //     $md5pass = md5($pass);
//     //     $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
//     //     $query->execute(['user' => $user, 'pass' => $md5pass]);

//     //     if($query->rowCount()){
//     //         return true;
//     //     }else{
//     //         return false;
//     //     }
//     // }

//     public function userExists($user, $pass)
//     {
//         $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
//         $query->execute(['user' => $user]);

//         if ($query->rowCount()) {
//             $userRow = $query->fetch(PDO::FETCH_ASSOC);
//             return password_verify($pass, $userRow['password']);
//         } else {
//             return false;
//         }
//     }

//     public function registerUser($user, $pass, $email)
//     {
//         $hashedPass = password_hash($pass, PASSWORD_DEFAULT); // Hash seguro de contraseña

//         $query = $this->connect()->prepare('INSERT INTO usuarios (username, password, email) VALUES (:user, :pass, :email)');

//         try {
//             $query->execute(['user' => $user, 'pass' => $hashedPass, 'email' => $email]);
//             return true; // Registro exitoso
//         } catch (PDOException $e) {
//             echo "Error de registro: " . $e->getMessage();
//             return false; // Error en el registro
//         }
//     }


//     public function setUser($user)
//     {
//         $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
//         $query->execute(['user' => $user]);

//         foreach ($query as $currentUser) {
//             $this->nombre = $currentUser['nombre'];
//             $this->username = $currentUser['username'];
//         }
//     }

//     public function getNombre()
//     {
//         return $this->nombre;
//     }
// }
