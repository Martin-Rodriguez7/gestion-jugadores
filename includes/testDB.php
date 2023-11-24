<?php

// Incluye la clase DB
include('./db.php');  // Asegúrate de que la ruta sea correcta

// Crea una instancia de la clase DB
$db = new DB();

try {
    // Intenta establecer una conexión
    $pdo = $db->connect();

    // Si la conexión es exitosa, muestra un mensaje
    echo "Conexión exitosa a la base de datos";

    // Opcional: Puedes realizar más pruebas o consultas aquí
} catch (PDOException $e) {
    // En caso de error, muestra el mensaje de error
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>
