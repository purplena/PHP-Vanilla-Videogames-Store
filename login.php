<?php require './db-config/config.php'; ?>
<?php require './partials/_header.php'; ?>
<?php require './functions/helpers.php'; ?>
<?php require './db-queries/get_list_of_consoles.php'; ?>
<?php require './db-queries/get_list_of_games_by_age.php'; ?>
<?php require './partials/_navbar.php'; ?>
<?php require './db-queries/get_all_games.php'; ?>
<?php require './db-queries/get_all_games_by_age.php'; ?>
<?php require './partials/_game-card.php'; ?>
<?php require './partials/_form.php'; ?>


<main class="section-container">

 <section class="section">
  <?php
  form(
   "Se connecter",
   "./db-queries/authentication.php",
   "Se connecter",
   "Vous n'avez pas de compte?",
   "./register.php",
   "Inscrivez-vous!"
  )
  ?>

 </section>
</main>



<?php require './partials/_footer.php'; ?>