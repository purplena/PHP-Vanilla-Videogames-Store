<?php
require '../db-config/config.php';
require '../functions/helpers.php';
session_start();

if (isset($_SESSION['id'])) {

    global $connection;
    // Here we take all variables after submitting the form
    $titre = validate($_POST['titre']);
    $description = validate($_POST['description']);
    $prix = $_POST['prix'];
    $created_at = $_POST['date_sortie'];
    $user_id = $_SESSION['id'];
    $image = $_FILES["image"];
    $age_id = get_age_id($_POST['age_id']);
    $note_media = $_POST['note_media'];
    $note_utilisateur = $_POST['note_utilisateur'];

    // Here I make the basic validation
    if (empty($titre) || empty($description) || empty($prix) || empty($created_at) || empty($image) || empty($note_media) || empty($note_utilisateur)) {
        header("Location: ../add-new-game.php?error=Veuillez remplir tous les champs");
        exit();
    }

    //We check the price. I know that it is not the best way to do it. But I decided not to change the integrity of the existing database.
    $hasDot = strpos($_POST['prix'], '.') !== false;
    if ($hasDot) {
        header("Location: ../add-new-game.php?error=Veuillez saisir le prix sans virgule/point. Example: 9.99 = 10");
        exit();
    };

    //We take list of all consoles and stock them in the array $list_of_consoles
    $list_of_consoles = [];
    foreach ($_POST as $key => $value) {
        if ($value === 'on') {
            $list_of_consoles[] = $key;
        }
        $list_of_consoles;
    }

    if (count($list_of_consoles) == 0) {
        header("Location: ../add-new-game.php?error=Veuillez choisir la/les console(s)");
        exit();
    }


    //Here I check image(file) extensions
    $imageFileType = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedTypes)) {
        header("Location: ../add-new-game.php?error=Veuillez ajouter JPG, JPEG on PNG");
        exit();
    }


    //Here we redirect our image to the right folder and create $image_path that will be inserted to the DB
    $targetDir = "../images/games/";
    $targetFile = $targetDir . basename($image["name"]);
    $image_path = basename($image["name"]);
    if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
        die("Error uploading image.");
    }

    // Here I insert notes in the table `note`
    $query_note = "INSERT INTO `note`(`note_media`,`note_utilisateur`) VALUES (?, ?)";
    if ($stmt = mysqli_prepare($connection, $query_note)) {
        mysqli_stmt_bind_param(
            $stmt,
            'ii',
            $note_media,
            $note_utilisateur
        );
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../add-new-game.php?error=Le post n'a pas pu s'enregistrer");
            exit();
        }
    }

    //Here I take the highest id of the note to make a connection between jeu.note_id = note.id
    $note_id = get_highest_id();

    // Requete pour inserer dans la table `JEU`
    $query_jeu = "INSERT INTO `jeu`(`titre`,`description`,`date_sortie`, `prix`, `user_id`, `image_path`, `age_id`, `note_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($connection, $query_jeu)) {
        mysqli_stmt_bind_param(
            $stmt,
            'sssiisii',
            $titre,
            $description,
            $created_at,
            $prix,
            $user_id,
            $image_path,
            $age_id,
            $note_id
        );
        if (!mysqli_stmt_execute($stmt)) {
            header("Location: ../add-new-game.php?error=Le post n'a pas pu s'enregistrer");
            exit();
        }
    }



    //Here I take the highest id of the JEU to make a connection between jeu.id = game_console.jeu_id
    $jeu_id = get_highest_id_jeu();
    $list_of_console_id = [];
    //In this loop I create an array $list_of_console_id by replacing the console.label by console.id
    foreach ($list_of_consoles as $console) {
        $query = "SELECT console.id FROM console WHERE console.label = ?";
        if ($stmt = mysqli_prepare($connection, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $console);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    //Here I work with $console_id individually
                    while ($console_id = mysqli_fetch_assoc($result)) {
                        //In this loop I insert $console_id in the table `game_console`
                        $query_console = "INSERT INTO `game_console`(`console_id`,`jeu_id`) VALUES (?, ?)";
                        if ($stmt = mysqli_prepare($connection, $query_console)) {
                            mysqli_stmt_bind_param(
                                $stmt,
                                'ii',
                                $console_id['id'],
                                $jeu_id
                            );
                            if (!mysqli_stmt_execute($stmt)) {
                                header("Location: ../add-new-game.php?error=Le post n'a pas pu s'enregistrer");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }


    //on ferme la connexion
    mysqli_close($connection);

    //on redirige sur la page d'accueil
    header("Location: ../my-games.php");
} else {
    header("Location: ../add-new-game.php?error=Une erreur est survenue lors de la reception des données");
    exit();
}


function get_age_id($age_label)
{
    global $connection;
    $query = "SELECT restriction_age.id FROM restriction_age WHERE restriction_age.label = ?";
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $age_label);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($age_id = mysqli_fetch_assoc($result)['id']) {
                    return $age_id;
                }
            }
        }
    }
}


function get_highest_id()
{
    global $connection;
    $query = "SELECT MAX(id) AS max_id FROM note";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($highest_id = mysqli_fetch_assoc($result)['max_id']) {
                return $highest_id;
            }
        }
    }
}

function get_highest_id_jeu()
{
    global $connection;
    $query = "SELECT MAX(id) AS max_id FROM jeu";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($highest_id = mysqli_fetch_assoc($result)['max_id']) {
                return $highest_id;
            }
        }
    }
}
