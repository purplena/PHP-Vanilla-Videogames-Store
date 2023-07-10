<?php
session_start();
session_destroy();
header("Location: ../login.php?error=Vous avez été déconnecté");
