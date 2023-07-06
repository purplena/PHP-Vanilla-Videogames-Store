<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './db-queries/get_list_of_consoles.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_all_games.php'; ?>
<?php require './partials/_game-card.php'; ?>
<?php require './functions/helpers.php'; ?>

<main class="section-container">
    <?php if (isset($_GET['console_id'])) {
        $console_id = intval($_GET['console_id']);
        get_console_title_by_console_id($console_id);
    } else {
        "";
    }

    ?>
    <section class="section section-all-games">
        <?php if (isset($_GET['console_id'])) {
            $console_id = intval($_GET['console_id']);
            get_all_games($console_id);
        } else {
            get_all_games(0);
        }

        ?>

    </section>
</main>





<?php require './partials/_footer.php'; ?>