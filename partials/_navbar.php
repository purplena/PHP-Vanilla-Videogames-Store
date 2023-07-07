<div class="d-flex flex-column navbar-container">
    <div>
        <a href="../index.php">
            <img class="m-2 logo logo-image" src="../images/logo.png" alt="Logo du site">
        </a>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" aria-current="page" href="../index.php">Tous les jeux</a>
                    </li>
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
                            Trier
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'prix', 'direction' => 'asc']) ?>">
                                    Prix croissant
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'prix', 'direction' => 'desc']) ?>">
                                    Prix décroissant
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../index.php?<?php echo generateQueryParameters(['order' => 'note_media', 'direction' => 'desc']) ?>">
                                    Meilleur note presse
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href=" ../index.php?<?php echo generateQueryParameters(['order' => 'note_utilisateur', 'direction' => 'desc']) ?>">
                                    Meilleur note utilisateur
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom-drop-filters" aria-current="page" href="../index.php">Drop filters</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>