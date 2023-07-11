<?php
function get_all_games_by_user($user_id)
{
    global $connection;
    $query = "SELECT jeu.id, jeu.titre, jeu.description, jeu.image_path as game_image, jeu.date_sortie, restriction_age.image_path as age_image, restriction_age.label as min_age, note.note_media, note.note_utilisateur, jeu.user_id
                FROM jeu 
                INNER JOIN restriction_age ON jeu.age_id = restriction_age.id
                INNER JOIN note on jeu.note_id = note.id
                INNER JOIN user on jeu.user_id = user.id
                WHERE jeu.user_id=?";

    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($game = mysqli_fetch_assoc($result)) {
                    render_card_game_detailed($game);
                }
            }
        }
    }
}
