<?php function get_all_games()
{
    global $connection;
    // On créer la requete sql
    // if ($brand_id == 0) {
        $query = "SELECT id, titre, prix, image_path FROM jeu";
        // On éxécute la requete DIRECT
        if ($result = mysqli_query($connection, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($game= mysqli_fetch_assoc($result)) {
                    render_game($game);
                }
            } 
        }
    // } else {
    //     $query = "SELECT id, name, price, image FROM toys WHERE brand_id = ?";
    //             //on prepare la REQUETE PREPARé!
    //     if($stmt = mysqli_prepare($connection, $query)) {
    //         mysqli_stmt_bind_param($stmt, 'i', $brand_id);
    //         if(mysqli_stmt_execute($stmt)) {
    //             $result = mysqli_stmt_get_result($stmt);
    //             if(mysqli_num_rows($result)>0) {
    //                 while($toy = mysqli_fetch_assoc($result)) {
    //                     // render_toy($toy);
    //                 }
    //             }
    //         }
    //     }
    // }
}