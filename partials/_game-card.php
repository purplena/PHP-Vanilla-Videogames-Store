<?php

function render_game($game)
{
?>
    <div class="card-container">

        <img class="game_image" src="../images/games/<?php echo $game['image_path'] ?>" alt="image de <?php echo $game['titre'] ?>">
        <h3 class="game_name"><?php echo $game['titre']; ?></h3>
        <p class="game_price"><?php echo $game['prix'] == 0 ? "GRATUIT" : price_converter($game['prix']) . "€" ?></p>
        <div class="big-review-container-for-small-card" style="padding-left: 1rem;">
            <div class="small-review-container">
                <div><i class="fa-sharp fa-solid fa-star" style="color: #f2d72c;"></i></div>
                <p>Avis presse: <span class="text-bold text-blue"><?php echo $game['note_media'] ?></span>/20</p>
            </div>
            <div class="small-review-container">
                <div><i class="fa-sharp fa-solid fa-star" style="color: #f2d72c;"></i></div>
                <p>Avis utilisateur: <span class="text-bold text-blue"><?php echo $game['note_utilisateur'] ?></span>/20</p>
            </div>
        </div>
        <a class="see-details-button btn btn-primary" href="../detail.php?<?php echo generateQueryParameters(['jeu_id' => $game['id']]); ?>">Voir detail</a>

    </div>
<?php
}
