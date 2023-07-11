<?php
require '../db-config/config.php';
require '../functions/helpers.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);
    if (empty($email)) {
        header("Location: ../login.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../login.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=Veuillez saisir un email valide");
        exit();
    } else {
        global $connection;
        $query = "SELECT * FROM `user` WHERE email = '$email'";
        if ($result = mysqli_query($connection, $query)) {
            if (mysqli_num_rows($result) < 1) {
                mysqli_close($connection);
                header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                exit();
            }
            while ($user = mysqli_fetch_assoc($result)) {
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];
                    mysqli_close($connection);
                    header("Location: ../index.php");
                } else {
                    mysqli_close($connection);
                    header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                    exit();
                }
            }
        }
    }
}
