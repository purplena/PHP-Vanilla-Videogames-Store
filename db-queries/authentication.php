<?php
require '../db-config/config.php';
require '../functions/helpers.php';

//1- on vérifie que l'on recoit bien les données du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {


    //3- On crée nos variables qui vont contenir les données sécurisées
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);


    //maintenant que nos données sont receptionnées et sécurisées
    //on va effectuer plusieurs traitements
    //5- Gestion des erreurs
    //on verifie que l'email est rempli
    if (empty($email)) {
        //on renvoie en GET à index.php le paramètre "?error=Veuillez saisir l'email"
        header("Location: ../login.php?error=Veuillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../login.php?error=Veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=Veuillez saisir un email valide");
        exit();
    } else {
        //on va vérifier que l'utilisateur existe bien dans la BDD
        global $connection;
        //on crée la requete sql
        $query = "SELECT * FROM `user` WHERE email = '$email'";
        //on execute la requete
        if ($result = mysqli_query($connection, $query)) {
            //on regarde si on a un résultat qui sort
            if (mysqli_num_rows($result) < 1) {
                //on ferme la connexion
                mysqli_close($connection);
                //si on a pas de résultat on renvoie un message d'erreur
                header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                exit();
            }
            //si on a un résultat on vérifie le combo email / mot de passe
            while ($user = mysqli_fetch_assoc($result)) {
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    //on crée la session
                    session_start();
                    //on stock en session l'email et l'id de l'utilisateur
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];
                    //on ferme la connexion
                    mysqli_close($connection);

                    //on redirige vers la page home
                    header("Location: ../index.php");
                } else {
                    //on ferme la connexion
                    mysqli_close($connection);
                    header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                    exit();
                }
            }
        }
    }
}
