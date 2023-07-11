<div class="d-flex flex-column navbar-container">
    <?php session_start(); ?>
    <div class="d-flex flex-row justify-content-between">
        <div>
            <a href="../index.php">
                <img class="m-2 logo logo-image" src="../images/logo.png" alt="Logo du site">
            </a>
        </div>

        <div class="d-flex align-items-center gap-3">
            <?php if (!isset($_SESSION['email'])) { ?>
                <a href="../register.php" class="btn btn-primary">S'enregistrer</a>
                <a href="../login.php" class="login-btn">Se connecter</a>
            <?php } else { ?>
                <p class="mb-0">Bienvenue <span class="text-bold" style="color: #ac2886;"><?php echo $_SESSION['email'] ?></span></p>
                <a href="../add-new-game.php" class="btn btn-primary">Ajouter un jeu</a>
                <a href="../db-queries/logout.php" class="login-btn">Déconnexion</a>
            <?php } ?>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" aria-current="page" href="../index.php">Tous les jeux</a>
                    </li>
                    <?php if (isset($_SESSION['email'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom nav-link-my-games" aria-current="page" href="../my-games.php">Mes jeux</a>
                        </li>
                    <?php } ?>
                    <?php if (!($_SERVER['REQUEST_URI'] == "/my-games.php" || $_SERVER['REQUEST_URI'] == "/add-new-game.php")) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Par console
                            </a>
                            <ul class="dropdown-menu">
                                <?php get_list_of_consoles() ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Par age
                            </a>
                            <ul class="dropdown-menu">
                                <?php get_list_of_games_by_age() ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle filter-custom" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-filter"></i> Trier
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                <li>
                                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'prix', 'direction' => 'asc'], 'page') ?>">
                                        Prix croissant
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'prix', 'direction' => 'desc'], 'page') ?>">
                                        Prix décroissant
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'note_media', 'direction' => 'desc'], 'page') ?>">
                                        Meilleur note presse
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href=" ../index.php?<?php echo generateQueryParameters(['order' => 'note_utilisateur', 'direction' => 'desc'], 'page') ?>">
                                        Meilleur note utilisateur
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link filter-custom filter-custom-danger" aria-current="page" href="../index.php">Effacer tous</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>