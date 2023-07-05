<?php
define('DB_HOST', 'database');
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_NAME', 'toysrus');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$connection) {
    die('Erreur: ' . mysqli_connect_error()); // "die" c'est pour stop le script
}


mysqli_set_charset($connection, 'utf8');