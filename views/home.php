<?php
include_once '../includes/user_session.php';
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
}
$userSession = new userSession();

if (!$userSession->getCurrentUser()) {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- <script src="https://cFdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="../Bootstrap/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="../Bootstrap/bootstrap.min.css"> -->
    <title>Real Madrid</title>
</head>

<body>
    <?php include('../layout/navbar.php'); ?>
    <div class="container bg-light shadow p-3 rounded-4">
        <div id="title_page" class="title_page shadow-sm rounded-4 text-center m-2">
            <h2 class="fw-bold pt-2">Plantilla de jugadores</h2>
        </div>
        <div id="content" class="bg-light">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-5 ">
                    <input type="text" class="form-control shadow-sm rounded-5 p-3" id="busqueda" placeholder="Buscar..." aria-label="Buscar" aria-describedby="boton-buscar">
                </div>
                <div class="col-md-5  mt-3 d-flex justify-content-center align-items-center p-2">
                    <a id="btn_agregar_jugador" class="boton_a fw-bold mb-2 p-4 text-decoration-none text-dark shadow-sm rounded-2 p-3 m-2" data-bs-toggle="modal" href="#" data-bs-target="#cargarJugadorModal">Registrar jugador</a>
                </div>
            </div>
        </div>
        <div id="data" class="mb-2 row mt-3">

        </div>
    </div>
</body>
<script>
    var username_sistem = <?php echo json_encode($username); ?>;
</script>

<script type="module" src="../JS/jugador_abm.js"></script>
<script type="module" src="../JS/cuenta_cte.js"></script>
<?php require('../layout/modals.php') ?>
<script src="../JS/usuarios_abm.js"></script>

</html>