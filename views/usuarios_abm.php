<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="../css/estilos.css"> -->
    <link rel="stylesheet" href="../Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Boca Juniors</title>
</head>

<body>
    <?php include('../layout/navbar.php'); ?>

    <div class="container bg-light shadow p-3 rounded-4">
        <div id="title_page" class="title_page shadow-sm rounded-4 text-center m-2">
            <h2 class="fw-bold pt-2">Usuarios</h2>
        </div>

        <div id="content" class="bg-light">

            <div class="row m-3 rounded-3">
                <div class="col p-1 rounded shadow-sm m-4">
                    <form id="register_form" method="POST" class="m-3">
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bolder fs-5">Correo electonico</label>
                            <input type="email" id="email" class="form-control p-2" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="nombre_completo" class="form-label fw-bolder fs-5">Nombre completo</label>
                            <input type="text" id="nombre_completo" class="form-control p-2" name="nombre_completo" required>
                        </div>
                        <div class="mb-4">
                            <label for="username" class="form-label fw-bolder fs-5">Username</label>
                            <input type="text" id="username" class="form-control p-2" name="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="dni_user" class="form-label fw-bolder fs-5">DNI</label>
                            <input type="number" id="dni_user" class="form-control p-2" name="dni_user" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bolder fs-5">Contraseña</label>
                            <input type="password" id="password" class="form-control p-2" name="password" required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confir" class="form-label fw-bolder fs-5">Confirmar contraseña</label>
                            <input type="password_confir" class="form-control p-2" name="password_confir" required>
                        </div>
                        <div class="mb-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="tipo_us" class="form-label">Tipo de usuario</label>
                            <select class="form-select" id="tipo_us" name="tipo_us" required>
                                <option value="1">Admin</option>
                                <option value="2">Empleado</option>
                                <option value="3">Usuario</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn bg-primary p-2 fs-4 rounded-5 text-white text-center">Guardar</button>
                        </div>

                    </form>
                </div>
                <div class="col d-none d-lg-block col-md-5 col-lg-5 col-xl-6 p-5">
                    <img class="mx-auto d-block w-75" id="add-user-img" src="../img/add-user-profile.png" alt="img-alta-usuario">
                </div>
            </div>

        </div>

        <div id="data_content" class="mb-2">
            <table id="tabla_User" class="table mt-4 rounded-3 ">
                <thead>
                    <tr>
                        <!-- <th class="text-center ">ID</th> -->
                        <th class="text-center ">Nombre</th>
                        <th class="text-center ">Correo</th>
                        <!-- <th class="text-center ">Fecha de registracion</th> -->
                        <th class="text-center ">DNI</th>
                        <th class="text-center ">Username</th>
                        <th class="text-center ">Tipo</th>
                        <th class="text-center ">estado</th>
                    </tr>
                </thead>
                <tbody id="data_user">
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<?php require('../layout/modals.php') ?>
<script src="../JS/usuarios_abm.js"></script>

</html>