<?php

include './UserBusiness.php';
session_start();
if (isset($_POST['submit'])) {
    $userName = $_POST['user'];
    $pass = $_POST['pass'];

    if (isset($userName) && isset($pass)) {
        $userBusiness = new UserBusiness();
        $countUser = (int) $userBusiness->verifyUserNameUser($userName, $pass);

        if ($countUser > 0) {
            $user = $userBusiness->getUser($userName, $pass);

            $_SESSION['id'] = "" . $user->getIdPersonUser();
            $_SESSION['type'] = "" . $user->getTypeUser();

            header("location: ../presentation/Home.php?success=LOGIN");
        } else {
            header("location: ../presentation/Login.php?error=LOGIN_NO_USER_EXISTS");
        }
    } else {
        header("location: ../presentation/Login.php?error=LOGIN_ISSET");
    }
} else {
    header("location: ../presentation/Login.php?error=LOGIN_SUBMIT");
}