<?php
function get_list_of_consoles()
{
    global $connection;
    $query = "SELECT console.id, console.label, COUNT(game_console.jeu_id) as total 
FROM console
INNER JOIN game_console ON console.id=game_console.console_id
GROUP BY console.id";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($console = mysqli_fetch_assoc($result)) {
?>
                <li>
                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['console_id' => $console['id']]) ?>">
                        <?php echo $console['label'] ?> ( <?php echo $console['total'] ?> )
                    </a>
                </li>
<?php
            }
        }
    }
}
