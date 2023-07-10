<?php
require '../db-config/config.php';

//1-on verifie qu'on recoit bien les données du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    //2-on cree une fonction qui va securiser les donées recues 
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //3-on crée nos variables qui vont contenir les données sécurisées
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);

    //4-on doit encoder le password
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);

    //maintenant que nos données sont receptionnées et sécurisées
    //on va effectuer plusieur traitements

    //5-Gestion des erreurs
    if (empty($email) && empty($password)) {
        header("Location: ../register.php?error=Veillez remplir les deux champs");
        exit();
    }
    //ov verifie si email est rempli
    else if (empty($email)) {
        //on renvoie en GET à index.php le paramètre "?error=Veillez saisir email
        header("Location: ../register.php?error=Veillez saisir l'email");
        exit();
    }
    //ov verifie si email est rempli
    else if (empty($password)) {
        //on renvoie en GET à index.php le paramètre "?error=Veillez saisir email
        header("Location: ../register.php?error=Veillez saisir le mot de pass");
        exit();
    }
    //Ligne qui verefie que c'est un veritable email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Veillez saisir l'email");
        exit();
    } else {
        global $mysqli;
        //on crée la requete sql
        $query_get = "SELECT * FROM user WHERE email = '$email'";

        if ($result = mysqli_query($connection, $query_get)) {
            //on regarde si on a un résultat qui sort
            if (mysqli_num_rows($result) > 0) {
                //on ferme la connexion
                mysqli_close($connection);

                //si on a un résultat on renvoie un message d'erreur
                header("Location: ../index.php?error=Cet email existe déjà");
                exit();
            } else {
                //si on a pas de résultat on peut inserer dans la BDD
                //on crée la requete sql
                global $connection;
                //on crée la requete sql
                $query_get = "SELECT * FROM user WHERE email = '$email'";

                if ($result = mysqli_query($connection, $query_get)) {
                    //on regarde si on a un résultat qui sort
                    if (mysqli_num_rows($result) > 0) {
                        //on ferme la connexion
                        mysqli_close($connection);

                        //si on a un résultat on renvoie un message d'erreur
                        header("Location: ../register.php?error=Cet email existe déjà");
                        exit();
                    } else {
                        //si on a pas de résultat on peut inserer dans la BDD
                        //on crée la requete sql
                        $query_post = "INSERT INTO user (email, password) VALUES ('$email', '$pass_hash')";
                        if (mysqli_query($connection, $query_post)) {
                            //si l'insertion est bien faite on récupère l'utilisateur 
                            //pour créer la session
                            if ($new_result = mysqli_query($connection, $query_get)) {
                                while ($new_user = mysqli_fetch_assoc($new_result)) {
                                    if ($new_user['email'] === $email && $new_user['password'] === $pass_hash) {
                                        //on peut creer la session
                                        session_start();
                                        //on va stocker l'email et l'id de l'utilisateur dans la session
                                        $_SESSION['email'] = $new_user['email'];
                                        $_SESSION['id'] = $new_user['id'];
                                        //on ferme la connexion
                                        mysqli_close($connection);

                                        //on redirige sur la page home.php
                                        header("Location: ../index.php");
                                    }
                                }
                            }
                        }
                    }
                } else {
                    //on ferme la connexion
                    mysqli_close($connection);
                    header("Location: ../index.php?error=Erreur de connexion à la BDD");
                    exit();
                }
                //TODO 3: Pour tous les cas, on gère les erreurs
            }
        }
    }
}
