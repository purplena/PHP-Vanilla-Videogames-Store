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


<!-- <?php session_start(); ?> -->

<main class="section-container">
	<section class="section">
		<?php
		if (isset($_SESSION['email'])) {
			header("Location: ./index.php");
			exit();
		} else {
			form(
				"Créer un compte",
				"./db-queries/registration.php",
				"S'enregistrer",
				"Vous avez déjà un compte?",
				"./login.php",
				"Connectez-vous!"
			);
		};
		?>
	</section>
</main>

<?php require './partials/_footer.php'; ?>