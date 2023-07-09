<?php function get_all_games($console_id, $order, $direction, $currentPage)
{
    global $connection;
    $recordsPerPage = 4;
    $startFrom = ($currentPage - 1) * $recordsPerPage;
    if ($console_id == 0) {
        $basic_query = "SELECT jeu.id, jeu.titre, jeu.prix, jeu.image_path, note.note_media, note.note_utilisateur 
                        FROM jeu
                        INNER JOIN note ON jeu.note_id = note.id";
        if ($order == "" && $direction == "") {
            $query = $basic_query;
        } else {
            $query = $basic_query . " ORDER BY " . $order . " " . $direction;
        }
        $final_query = $query . " LIMIT " . $startFrom . ", " . $recordsPerPage;
        if ($result = mysqli_query($connection, $final_query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($game = mysqli_fetch_assoc($result)) {
                    render_game($game);
                }
            }
        }
    } else {
        global $connection;
        $recordsPerPage = 4;
        $startFrom = ($currentPage - 1) * $recordsPerPage;

        $basic_query = "SELECT jeu.id, jeu.titre, jeu.prix, jeu.image_path, console.label, note.note_media, note.note_utilisateur 
                FROM jeu
                INNER JOIN note ON jeu.note_id = note.id
                INNER JOIN game_console ON game_console.jeu_id=jeu.id
                INNER JOIN console ON game_console.console_id=console.id 
                WHERE console.id = ?
                ";
        if ($order == "" && $direction == "") {
            $query = $basic_query;
        } else {
            $query = $basic_query . " ORDER BY " . $order . " " . $direction;
        }
        $final_query = $query . " LIMIT " . $startFrom . ", " . $recordsPerPage;
        if ($stmt = mysqli_prepare($connection, $final_query)) {
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


function get_all_pages()
{
    global $connection;
    $recordsPerPage = 4;
    // Get the total number of records in the database
    $totalRecords = mysqli_query($connection, "SELECT COUNT(*) AS total FROM jeu;");
    $totalRecords = mysqli_fetch_assoc($totalRecords)['total'];
    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    return $totalPages;
}

function get_all_pages_by_console($console_id)
{
    global $connection;
    $recordsPerPage = 4;
    $query = "SELECT COUNT(jeu.id) AS total, game_console.console_id FROM jeu
                INNER JOIN game_console ON jeu.id = game_console.jeu_id 
                WHERE game_console.console_id = ?
                GROUP BY game_console.console_id";
    if ($stmt = mysqli_prepare($connection, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $console_id);
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
