<?php
function form($title, $action, $button_name, $text, $link, $button_link)
{
?>

    <form id="form" action="<?php echo $action ?>" method="post">
        <h2><?php echo $title; ?></h2>
        <!-- Error messages -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET["error"]; ?></p>
        <?php } ?>
        <label class="label-in-register-form" for="email">Email</label>
        <input class="input-in-register-form" type="text" name="email" placeholder="Votre email">
        <label class="label-in-register-form" for="password">Mot de passe</label>
        <input class="input-in-register-form" type="password" name="password" placeholder="Votre mot de passe">
        <div class="box_button">
            <button class="btn btn-primary" type="submit"><?php echo $button_name; ?></button>
            <p class="sub_text"><?php echo $text; ?>
                <a class="contrast-color" href="<?php echo $link; ?>" class="link"><?php echo $button_link; ?></a>
            </p>
        </div>
    </form>

<?php
}
?>