<?php

function get_all_games_by_age($restiction_age, $order, $direction)
{
    global $connection;
    $basic_query = "SELECT jeu.id, jeu.titre, jeu.prix, jeu.image_path, restriction_age.label, note.note_media, note.note_utilisateur 
                    FROM jeu
                    INNER JOIN note ON jeu.note_id = note.id
                    INNER JOIN restriction_age ON jeu.age_id = restriction_age.id
                    WHERE restriction_age.label  = ?";
    if ($order == "" && $direction == "") {
        $query = $basic_query;
    } else {
        $query = $basic_query . " ORDER BY " . $order . " " . $direction;
    }
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $restiction_age);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($game = mysqli_fetch_assoc($result)) {
                    render_game($game);
                }
            }
        }
    }
}
