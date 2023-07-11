<?php
require '../db-config/config.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);

    $pass_hash = password_hash($password, PASSWORD_BCRYPT);

    if (empty($email) && empty($password)) {
        header("Location: ../register.php?error=Veillez remplir les deux champs");
        exit();
    } else if (empty($email)) {
        header("Location: ../register.php?error=Veillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../register.php?error=Veillez saisir le mot de pass");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Veillez saisir l'email");
        exit();
    } else {
        global $mysqli;
        $query_get = "SELECT * FROM user WHERE email = '$email'";

        if ($result = mysqli_query($connection, $query_get)) {
            if (mysqli_num_rows($result) > 0) {
                mysqli_close($connection);
                header("Location: ../register.php?error=Cet email existe déjà");
                exit();
            } else {

                global $connection;
                $query_get = "SELECT * FROM user WHERE email = '$email'";

                if ($result = mysqli_query($connection, $query_get)) {
                    if (mysqli_num_rows($result) > 0) {
                        mysqli_close($connection);

                        header("Location: ../register.php?error=Cet email existe déjà");
                        exit();
                    } else {
                        $query_post = "INSERT INTO user (email, password) VALUES ('$email', '$pass_hash')";
                        if (mysqli_query($connection, $query_post)) {
                            if ($new_result = mysqli_query($connection, $query_get)) {
                                while ($new_user = mysqli_fetch_assoc($new_result)) {
                                    if ($new_user['email'] === $email && $new_user['password'] === $pass_hash) {
                                        session_start();
                                        $_SESSION['email'] = $new_user['email'];
                                        $_SESSION['id'] = $new_user['id'];
                                        mysqli_close($connection);

                                        header("Location: ../index.php");
                                    }
                                }
                            }
                        }
                    }
                } else {
                    mysqli_close($connection);
                    header("Location: ../index.php?error=Erreur de connexion à la BDD");
                    exit();
                }
            }
        }
    }
}
