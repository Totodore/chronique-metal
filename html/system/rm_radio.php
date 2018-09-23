<?php 
    $horaires = $bdd->query("SELECT * FROM live_programme");
    $current_timestamp = time();    //On recup le timestamp actuel

    while ($horaire = $horaires->fetch(PDO::FETCH_ASSOC)) { //Pour chaque horaire
        
        if ($current_timestamp > strtotime($horaire['date']." ".$horaire['time_start']) AND $horaire['date'] != "1111-11-11") { //Si le timestamp de la date de debut est plus petit que le timestamp actuel et que la date est bien paramétrée alors ca degage
            $bdd->query("DELETE FROM live_programme WHERE ID=".$horaire['ID']);
            echo $horaire['ID']."<br />"; }
    }
?>