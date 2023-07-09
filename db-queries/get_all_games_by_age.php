<?php

function get_all_games_by_age($restiction_age, $order, $direction, $currentPage)
{
    global $connection;
    $recordsPerPage = 4;
    $startFrom = ($currentPage - 1) * $recordsPerPage;
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
    $final_query = $query . " LIMIT " . $startFrom . ", " . $recordsPerPage;
    if ($stmt = mysqli_prepare($connection, $final_query)) {
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

function get_all_pages_by_age($restiction_age)
{
    global $connection;
    $recordsPerPage = 4;
    $query = "SELECT COUNT(jeu.id) as total, restriction_age.label FROM jeu
                INNER JOIN restriction_age ON restriction_age.id = jeu.age_id
                WHERE restriction_age.label = ?
                GROUP BY restriction_age.label";
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $restiction_age);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($totalRecords = mysqli_fetch_assoc($result)['total']) {
                    return ceil($totalRecords / $recordsPerPage);
                }
            }
        }
    }
}
