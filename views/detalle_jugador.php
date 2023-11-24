<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../index.php');
}
include_once '../model/userModel.php';

$userModel = new userModel();

if (isset($_GET['detalleID'])) {
    // $id_jugador = $_GET['id_jugador'];
    $id_jugador = base64_decode($_GET['detalleID']);
    $username = $_SESSION['user'];
} else {
    $dataJugador = $userModel->getUserXJugador($_SESSION['user']);
    $cant_jugadores = count($dataJugador);


    if (!empty($dataJugador) && isset($dataJugador[0]['id_jugador'])) {
        $id_jugador = $dataJugador[0]['id_jugador'];
        $username = $_SESSION['user'];
    } else {
        // Maneja el caso en el que no se encuentra ningún jugador para el usuario actual.
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Real Madrid</title>
</head>

<body>
    <?php include('../layout/navbar.php'); ?>

    <div class="container bg-light shadow p-3 rounded-4">
        <div id="title_page" class="title_page shadow-sm rounded-4 text-center m-2">
            <h2 class="fw-bold pt-2">Detalle Jugador</h2>
        </div>
        <div class="container mt-4">
            <div id="s_jugadores" class="row d-none">
                <div class="col-md-3 shadow-sm bg-white rounded-4 m-3 p-3 text-center">
                    <div class="mb-3">
                        <label for="pierna_habil" class="form-label fw-bold">Jugadores vinculados</label>
                        <select class="form-select" id="name_jugador" name="name_jugador" required>

                        </select>
                        <!-- <input type="text" class="form-control" id="pierna_habil" name="pierna_habil" required> -->
                    </div>
                </div>
            </div>
            <div class="card rounded-5">

                <div class="row no-gutters">

                    <div class="col-md-3">
                        <img src="../img/detalle_jugador/detallejugador.png" width="50" class="card-img rounded-5" alt="Imagen del jugador">
                    </div>
                    <div class="col-md-8 ">
                        <div class="card-body row rounded-3">
                            <div class="col-md-6">
                                <h5 class="card-title fw-bold" id="id_nombre_apellido"></h5>
                                <p class="card-text fs-5" id="id_categoria"></p>
                                <p class="card-text fs-5" id="id_posicion"></p>
                                <p class="card-text fs-5" id="id_posicion_alt"></p>
                                <p class="card-text fs-5" id="id_dorsal"></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-title fs-5" id="id_fecha_nacimiento"></p>
                                <p class="card-text fs-5" id="id_mano_habil"></p>
                                <p class="card-text fs-5" id="id_pierna_habil"></p>
                                <p class="card-text fs-5" id="id_categoria"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <table class="table mt-4 rounded-3">
                <thead class="text-center">
                    <tr>
                        <th>N° cuota </th>
                        <th>Fecha cuota</th>
                        <th>Fecha Vencimiento</th>
                        <th>Importe</th>
                        <th>Estado</th>
                        <th>Accion</th>

                    </tr>
                </thead>
                <tbody class="text-center" id="data_player">
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</body>


<?php require('../layout/modals.php') ?>
<script>
    var id_jugador = <?php echo $id_jugador; ?>;
    var username_sistem = <?php echo json_encode($username); ?>;
    var cant_jugadores = <?php echo json_encode($cant_jugadores); ?>;
</script>
<script src="../Bootstrap/bootstrap.bundle.min.js"></script>
<script src="../JS/detalle_jugador.js"></script>
<!-- <script src="../JS/cuenta_cte.js"></script> -->

</html>