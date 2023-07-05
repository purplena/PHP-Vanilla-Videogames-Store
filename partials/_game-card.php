<?php

function render_game($game)
{
?>
<div class="card m-2" style="width: 12rem;">
    <div class="d-flex flex-column align-items-center justify-content-between card-body">
        <img class="toy_image" src="../images/games/<?php echo $game['image_path'] ?>"
            alt="image de <?php echo $game['titre'] ?>" style="width: 12rem">
        <h5 class="toy_name"><?php echo $game['titre']; ?></h5>
        <!-- <p class="toy_price"><?php echo price_converter($game['prix']); ?>€</p> -->
        <p class="toy_price"><?php echo $game['prix']==0 ? "GRATUIT" : price_converter($game['prix']) . "€" ?></p>
        <a href="../detail.php?jeu_id=<?php echo $game['id'] ?>">Voir detail</a>
    </div>
</div>
<?php
}