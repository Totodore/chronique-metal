<?php
    // Afficher les erreurs à l'écran
    ini_set('display_errors', 1);
    // Enregistrer les erreurs dans un fichier de log
    ini_set('log_errors', 1);
?>
<?php 
    function console_log($data)
    {
        $output = $data;
        if (is_array($output)) {
            $output = implode(',', $output);
        }

        echo "<script>console.log( '".$output. "' );</script>";
    }

    session_start();
    try {
        $bdd = new PDO('mysql:host=chroniquay12.mysql.db;dbname=chroniquay12;charset=utf8', 'chroniquay12', 'Chroniquay12', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // $bdd = new PDO('mysql:host=localhost;dbname=chronique-metal;charset=utf8', 'theodore', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    include 'rm_radio.php';
?>