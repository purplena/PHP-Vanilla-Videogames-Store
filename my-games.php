<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './functions/helpers.php'; ?>
<?php require './db-queries/get_list_of_consoles.php'; ?>
<?php require './db-queries/get_list_of_games_by_age.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_all_games.php'; ?>
<?php require './db-queries/get_all_games_by_age.php'; ?>
<?php require './partials/_game-card.php'; ?>
<?php require './db-queries/get_all_games_by_user.php'; ?>
<?php require './db-queries/get_game_by_id.php'; ?>
<?php require './partials/_card_game_detailed.php'; ?>


<main class="section-container">
    <h1>Mes jeux</h1>
    <section class="section">
        <div class="my-games-container">
            <?php if (get_all_games_by_user($_SESSION['id']) == null) { ?>
                <p>Tu peux ajouter ton jeu en cliquant ici <a class="contrast-color" href="./add-new-game.php">AJOUTER</a></p>
            <?php } else {
                get_all_games_by_user($_SESSION['id']);
            } ?>
        </div>
    </section>
</main>

<?php require './partials/_footer.php'; ?>