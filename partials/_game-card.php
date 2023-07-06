<?php

function render_game($game)
{
?>
    <div class="card-container">

        <img class="game_image" src="../images/games/<?php echo $game['image_path'] ?>" alt="image de <?php echo $game['titre'] ?>">
        <h3 class="game_name"><?php echo $game['titre']; ?></h3>
        <p class="game_price"><?php echo $game['prix'] == 0 ? "GRATUIT" : price_converter($game['prix']) . "€" ?></p>
        <a class="see-details-button btn btn-primary" href="../detail.php?jeu_id=<?php echo $game['id'] ?>">Voir detail</a>

    </div>
<?php
}
