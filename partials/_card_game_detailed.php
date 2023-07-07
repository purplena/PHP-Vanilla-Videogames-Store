<?php

function render_card_game_detailed($game)
{
?>
    <div class="detailed-card-container">
        <img class="image-in-detailed-card" src="../images/games/<?php echo $game['game_image'] ?>" alt="<?php echo $game['game_image'] ?>">
        <div>
            <h2><?php echo $game['titre']; ?></h2>
            <div class="console-container"><?php get_console_by_game_id($game['id']) ?></div>
            <p class="game-description"><span class="text-bold">Synopsis:</span> <?php echo ($game['description']) ?></p>
            <p class="release-date">Date de sortie: <span class="release-date-span text-bold"><?php echo date_converter($game['date_sortie']); ?></span></p>
            <div class="age-container">
                <img class="age-image" src="../images/pegi/<?php echo $game['age_image'] ?>" alt="<?php echo $game['age_image'] ?>">
                <span>age: <?php echo $game['min_age'] ?>+</span>
            </div>
            <div class="big-review-container">
                <div class="small-review-container">
                    <div><i class="fa-sharp fa-solid fa-star" style="color: #f2d72c;"></i></div>
                    <p>Avis presse: <span class="text-bold text-blue"><?php echo $game['note_media'] ?></span>/20</p>
                </div>
                <div class="small-review-container">
                    <div><i class="fa-sharp fa-solid fa-star" style="color: #f2d72c;"></i></div>
                    <p>Avis utilisateur: <span class="text-bold text-blue"><?php echo $game['note_utilisateur'] ?></span>/20</p>
                </div>
            </div>
        </div>
    </div>
<?php }

// function render_console($console)
// {
//     echo "<span>" . $console['console_name'] . "</span>" . "<br>";
// }
