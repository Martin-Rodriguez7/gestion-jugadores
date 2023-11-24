<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./Bootstrap/bootstrap.min.css">
</head>

<body>
    <div class="d-flex justify-content-center ">
        <div class="shadow rounded-4 p-5 mt-2">
            <div class=" text-center">
                <img src="./img/realmadrid.png" width="150" alt="">
            </div>
            <form action="./index.php" id="login_form" method="POST">
                <h2 class="fw-bold text-center pt-1 mb-2 ">Iniciar sesión</h2>
                <div class="mb-4">
                    <label for="username" class="form-label fw-bolder fs-5">Nombre de usuario</label>
                    <input type="username" id="username" class="form-control p-2" name="username" required>
                </div>
                <div>
                    <label for="password" class="form-label fw-bolder fs-5">Contraseña</label>
                    <input type="password" id="password_log" class="p-2" name="password" required>
                </div>
                <div class="form-check">
                    <?php
                    if (isset($errorLogin)) {
                        echo '<p class="error-message text-center">' . $errorLogin . '</p>';
                    }
                    ?>
                </div>
                <div class="d-grid">
                    <button type="submit" class="shadow-sm bg-white p-2 fs-4 rounded-5 text-center">Iniciar Sesion</button>
                </div>
                <div class="my-3 align-items-lg-baseline text-center">
                    <!-- <span class="me-3"><a href="#">¿Olvidaste tu Contraseña?</a></span> -->
                </div>
            </form>

        </div>

    </div>

</body>

</html>