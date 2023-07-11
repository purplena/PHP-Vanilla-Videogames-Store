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
                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['filter_name' => 'console_id', 'filter_value' => $console['id']], 'page') ?>">
                        <?php echo $console['label'] ?> ( <?php echo $console['total'] ?> )
                    </a>
                </li>
            <?php
            }
        }
    }
}

function get_short_list_of_consoles()
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
                <div>
                    <input type="checkbox" id="<?php echo $console['label'] ?>" name="<?php echo $console['label'] ?>">
                    <label for="<?php echo $console['label'] ?>"><?php echo $console['label'] ?></label>
                </div>
<?php
            }
        }
    }
}
