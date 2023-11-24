<?php

class UserSession
{

    public function __construct()
    {
        session_start();
    }

    public function setCurrentUser($user, $userRole)
    {
        $_SESSION['user'] = $user;
        $_SESSION['rol'] = $userRole;
    }

    public function getCurrentUser()
    {
        return $_SESSION['user'];
    }
    public function getCurrentUserRol()
    {
        return $_SESSION['rol'];
    }

    public function closeSession()
    {
        session_unset();
        session_destroy();
    }
}
