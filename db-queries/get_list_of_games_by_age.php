<?php
function get_list_of_games_by_age()
{
    global $connection;
    $query = "SELECT restriction_age.label, COUNT(jeu.age_id) AS total FROM restriction_age
            INNER JOIN jeu on jeu.age_id = restriction_age.id
            GROUP BY restriction_age.id";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($age = mysqli_fetch_assoc($result)) {
?>
                <li>
                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['filter_name' => 'restriction_age', 'filter_value' => $age['label']], 'price') ?>">
                        <?php echo $age['label'] ?> ans + ( <?php echo $age['total'] ?> )
                    </a>
                </li>
<?php
            }
        }
    }
}
