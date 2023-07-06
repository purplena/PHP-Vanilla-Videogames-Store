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
                        <?php

                        $query_parameters = [];
                        parse_str($_SERVER['QUERY_STRING'], $query_parameters);
                        var_dump($query_parameters);


                        function href_construnctor($order)
                        {
                            $baseURI = parse_url($_SERVER['REQUEST_URI'])['path'];
                            $queryString = $_SERVER['QUERY_STRING'];
                            if (strpos($queryString, "&")) {
                                $queryString = explode("&", $_SERVER['QUERY_STRING'])[0];
                            } else {
                                $queryString;
                            }
                            if ($baseURI == "/index.php") {
                                return ".." . $baseURI . "?order_par_prix=$order";
                            } else if ($baseURI == "/games_by_console.php") {
                                return ".." . $baseURI . "?" . $queryString . "&order_par_prix=$order";
                            }
                        }

                        ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?php echo href_construnctor("asc"); ?>">
                                    Prix croissant
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo href_construnctor("desc"); ?>">
                                    Prix décroissant
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Meilleur note presse
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Meilleur note utilisateur
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>