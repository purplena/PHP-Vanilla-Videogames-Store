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
    <h1 class="contrast-color">Ajoutez un nouveau jeux</h1>
    <section class="section">
        <form class="add-new-game-form" action="./db-queries/add_new_game.php" method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error-form-add"><?php echo $_GET['error'] ?></p>
            <?php } ?>
            <div style="display: flex; gap: 2rem;">
                <div style="display: flex; flex-direction: column;">
                    <label for="titre">Titre: </label>
                    <input class="input-title input" type="text" name="titre" placeholder="Titre de jeu">
                    <label for="description">Description: </label>
                    <textarea name="description" placeholder="Veuillez laisser la description du jeu" style="width: 100%; height: 200px;"></textarea>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <div class="div-price-date">
                        <label for="prix">Prix: </label>
                        <input class="input" type="number" min="1" step="any" name="prix" value="<?php echo isset($_POST['prix']) ? $_POST['prix'] : ''; ?>">
                        <label for="date_sortie">Date de sortie:</label>
                        <input class="input" type="datetime-local" name="date_sortie" value="<?php echo isset($_POST['date_sortie']) ? $_POST['date_sortie'] : ''; ?>">
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
                    </div>
                    <fieldset>
                        <legend>Disponible pour:</legend>
                        <?php get_short_list_of_consoles() ?>
                    </fieldset>
                </div>
            </div>
            <div style="display: flex; flex-direction: column;">
                <label class="custom-file-upload input-image">
                    <input type="file" name="image" value="<?php echo isset($_POST['image']) ? $_POST['image'] : ''; ?>">
                </label>
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </section>
</main>


<?php require './partials/_footer.php'; ?>