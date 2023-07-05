<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_all_games.php'; ?>
<?php require './partials/_game-card.php'; ?>
<?php require './functions/price_converter.php'; ?>
<?php require './db-queries/get_game_by_id.php'; ?>
<?php require './partials/_card_game_detailed.php'; ?>
<main>
    <h1>
        Detail de jeu
    </h1>



    <?php $game_id = intval($_GET['jeu_id']); ?>
    <?php get_game_by_id($game_id) ?>
</main>





<?php require './partials/_footer.php'; ?>