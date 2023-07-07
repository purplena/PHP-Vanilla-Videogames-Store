<?php function get_all_games($console_id, $order, $direction)
{
    global $connection;
    if ($console_id == 0) {
        $basic_query = "SELECT jeu.id, jeu.titre, jeu.prix, jeu.image_path, note.note_media, note.note_utilisateur 
                        FROM jeu
                        INNER JOIN note ON jeu.note_id = note.id";
        if ($order == "" && $direction == "") {
            $query = $basic_query;
        } else {
            $query = $basic_query . " ORDER BY " . $order . " " . $direction;
        }
        if ($result = mysqli_query($connection, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($game = mysqli_fetch_assoc($result)) {
                    render_game($game);
                }
            }
        }
    } else {
        $basic_query = "SELECT jeu.id, jeu.titre, jeu.prix, jeu.image_path, console.label, note.note_media, note.note_utilisateur 
                FROM jeu
                INNER JOIN note ON jeu.note_id = note.id
                INNER JOIN game_console ON game_console.jeu_id=jeu.id
                INNER JOIN console ON game_console.console_id=console.id WHERE console.id = ?
                ";
        if ($order == "" && $direction == "") {
            $query = $basic_query;
        } else {
            $query = $basic_query . " ORDER BY " . $order . " " . $direction;
        }
        if ($stmt = mysqli_prepare($connection, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $console_id);
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
}


function get_console_title_by_console_id($console_id)
{
    global $connection;
    $query = "SELECT console.id, console.label FROM console WHERE console.id = ?";
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $console_id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($console = mysqli_fetch_assoc($result)) { ?>
                    <h1>Les jeux desponible pour <span class="console-name"><?php echo $console['label']; ?></span></h1>
<?php }
            }
        }
    }
}
