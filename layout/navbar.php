  <?php session_start(); ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-3">
      <div class="container-fluid">
          <a class="navbar-brand d-flex  justify-content-center rounded-4 shadow-sm align-items-center ps-3 pe-3" href="../index.php">
              <img src="../img/realmadrid.png" width="50" alt="">
              Bienvenido <?php echo strtoupper($_SESSION['user']); ?>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto gap-2">
                  <li class="nav-item">
                      <a class="nav-link fs-6 p-3 shadow-sm  boton_a rounded-3" href="../index.php">Inicio</a>
                  </li>
                  <?php
                    if (isset($_SESSION['rol'])) {
                        $rol = $_SESSION['rol'];
                        if ($rol == 1) { // Admin
                            echo '<li class="nav-item">
                            <a class="nav-link fs-6 p-3  shadow-sm boton_a rounded-3" href="../views/usuarios_abm.php">Usuarios</a>
                        </li>';
                        } elseif ($rol == 2) { // Usuario

                        } elseif ($rol == 3) { // Empleado

                        }
                    }
                    ?>
                  <li class="nav-item">
                      <a class="nav-link fs-6 p-3  shadow-sm boton_a rounded-3" href="../includes/logout.php">Salir</a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>