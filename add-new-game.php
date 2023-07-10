<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './functions/helpers.php'; ?>
<?php require './db-queries/get_list_of_consoles.php'; ?>
<?php require './db-queries/get_list_of_games_by_age.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_all_games.php'; ?>
<?php require './db-queries/get_all_games_by_age.php'; ?>
<?php require './partials/_game-card.php'; ?>


<main class="section-container">
    <h1>Ajoutez un nouveau jeux</h1>
    <section class="section">
        <form class="add-new-game-form" action="./db-queries/add_new_game.php" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error-form-add"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <label for="titre">Titre: </label>
            <input class="input-title" type="text" name="titre" placeholder="Titre de jeu">
            <label for="description">Description: </label>
            <textarea name="description" rows="5" cols="33">Veuillez laisser la description du jeu</textarea>
            <div class="div-price-date">
                <label for="prix">Prix: </label>
                <input type="number" min="1" step="any" name="prix">
                <label for="date_sortie">Date de sortie:</label>
                <input type="datetime-local" name="date_sortie">
            </div>
            <div class="div-age-note">
                <label for="age_id">Restriction d'age:</label>
                <select name="age_id">
                    <option value="3">3</option>
                    <option value="7">7</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                </select>
                <label for="note_media">Note media:</label>
                <select name="note_media">
                    <?php
                    for ($i = 1; $i <= 20; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
                <label for="note_utilisateur">Ta note:</label>
                <select name="note_utilisateur">
                    <?php
                    for ($i = 1; $i <= 20; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
                <fieldset>
                    <legend>Disponible pour:</legend>
                    <?php get_short_list_of_consoles() ?>
                </fieldset>
            </div>
            <input class="input-image" type="file" name="image">
            <input type="submit" class="btn btn-primary">
        </form>
    </section>
</main>


<?php require './partials/_footer.php'; ?>