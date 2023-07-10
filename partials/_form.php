<?php
function form($title, $action, $button_name, $text, $link, $button_link)
{
?>
    <div id="wrapper">
        <form id="form" action="<?php echo $action ?>" method="post">
            <h2><?php echo $title; ?></h2>
            <!-- Pour afficher des message d'erreurs -->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET["error"]; ?></p>
            <?php } ?>
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Votre email">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" placeholder="Votre mot de passe">
            <div class="box_button">
                <button type="submit"><?php echo $button_name; ?></button>
                <p class="sub_text"><?php echo $text; ?>
                    <a href="<?php echo $link; ?>" class="link"><?php echo $button_link; ?></a>
                </p>
            </div>
        </form>
    </div>
<?php
}
?>