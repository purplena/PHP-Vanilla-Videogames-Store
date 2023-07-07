<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './functions/helpers.php'; ?>
<?php require './db-queries/get_list_of_consoles.php'; ?>
<?php require './db-queries/get_list_of_games_by_age.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_game_by_id.php'; ?>
<?php require './partials/_card_game_detailed.php'; ?>


<main class="section-container">
    <section class="section section-game-details">
        <?php $game_id = intval($_GET['jeu_id']); ?>
        <?php get_game_by_id($game_id) ?>
    </section>
</main>


<?php require './partials/_footer.php'; ?>