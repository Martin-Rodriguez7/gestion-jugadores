 <?php

    include './model/userModel.php';
    include_once './includes/user_session.php';

    $userSession = new userSession();
    $user = new userModel();

    if (isset($_SESSION['user'])) {

        $user->setUser($userSession->getCurrentUser());
        // $userRole->setUser($userSession->getCurrentUserRol());

        switch ($_SESSION['rol']) {
            case 1:
                header('location: ./views/home.php');
                break;

            case 2:
                header('location: ./views/home.php');
                break;
            case 3:
                header('location: ./views/detalle_jugador.php');
                break;
            default:
        }
        // include_once './views/home.php';
    } else if (isset($_POST['username']) && isset($_POST['password'])) {

        $userForm = $_POST['username'];
        $passForm = $_POST['password'];

        $result = $user->userExists($userForm, $passForm);

        if ($result['authenticated']) {
            //echo "Existe el usuario";
            $userRole = $result['rol'];
            $userSession->setCurrentUser($userForm, $userRole);
            $user = new userModel();
            $user->setUser($userForm);
            // header('location: views/home.php');
            switch ($userRole) {
                case 1:
                    header('location: ./views/home.php');
                    break;

                case 2:
                    header('location: ./views/home.php');
                    break;
                case 3:
                    header('location: ./views/detalle_jugador.php');
                    break;

                default:
            }
            // header('location: views/home.php');
            // include_once './views/home.php';
        } else {
            //echo "No existe el usuario";
            $p_error = "S";
            $errorLogin = "Nombre de usuario y/o contraseña incorrecta";
            // header('location: ./views/login.php');
            include_once './views/login.php';
        }
    } else {
        //echo "login";
        include_once './views/login.php';
        // header('location: ./views/login.php');
    }

    // header('Content-Type: application/json');
    // echo json_encode($data);
    ?>
