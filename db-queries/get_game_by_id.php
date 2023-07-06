<?php

function get_game_by_id($game_id)
{
    global $connection;
    $query = "SELECT jeu.id, jeu.titre, jeu.description, jeu.image_path as game_image, jeu.date_sortie, restriction_age.image_path as age_image, restriction_age.label as min_age, note.note_media, note.note_utilisateur 
    FROM jeu 
    INNER JOIN restriction_age ON jeu.age_id = restriction_age.id
    INNER JOIN note on jeu.note_id = note.id
    WHERE jeu.id = ?";

    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $game_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($game = mysqli_fetch_assoc($result)) {
                    render_card_game_detailed($game);
                }
            }
        }
    }
};

function get_console_by_game_id($game_id)
{
    global $connection;
    $query = "SELECT jeu.id, console.label as console_name FROM jeu 
    INNER JOIN game_console ON jeu.id = game_console.jeu_id
    INNER JOIN console ON game_console.console_id = console.id
    WHERE jeu.id = ?";

    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $game_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($console = mysqli_fetch_assoc($result)) { ?>
                    <span class="console-span"><?php echo $console['console_name'] ?></span>
<?php }
            }
        }
    }
}
