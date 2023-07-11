<?php
require '../db-config/config.php';
if (isset($_GET['jeu_id'])) {

    global $connection;
    //C'était la fin de TP. Je n'ai pas fait prepared statements
    $jeu_id = intval($_GET['jeu_id']);

    $query1 = "DELETE FROM game_console WHERE jeu_id = $jeu_id";
    if (!mysqli_query($connection, $query1)) {
        header("Location: ../my-games?error= Une erreur est survenue lors de la suppression du post");
    }


    $query2 = "DELETE FROM jeu WHERE id = $jeu_id";
    if (mysqli_query($connection, $query2)) {
        header("Location: ../my-games.php");
        exit();
    } else {
        header("Location: ../my-games?error= Une erreur est survenue lors de la suppression du post");
    }

    //In this part I tried to delete by jeu.note_id = note.id from the table notes
    // The problem is about the structure of the data base. 
    //I can delete notes only after deleting a game. But If I delete first a game, I have NO link between two tables because jeu.id does not exist anymore

    // $note_id_query = "SELECT note_id from jeu WHERE id = $jeu_id";
    // $result = mysqli_query($connection, $note_id_query);
    // $note_id = (mysqli_fetch_assoc($result))['note_id'];
    // $query3 = "DELETE FROM note WHERE id = $note_id";
    // if (mysqli_query($connection, $query3)) {
    //     header("Location: ../my-games.php");
    //     exit();
    // } else {
    //     header("Location: ../my-games?error= Une erreur est survenue lors de la suppression du post");
    // }
}
