<?php 
    include '../../src/html/system/init.php';
    $id = $_GET['id'];
    $type = $_GET['type'];
    function str_process($str) {
        $str = stripslashes($str);  //On supprimes les backslashes de protection
        $str = strip_tags($str); //On vire tous les tags html
        return $str;
    }

    $file_tbl = $bdd->query('SELECT * from '.$type.' where ID='.$id);
    if (is_bool($file_tbl)) {   //SI le résultat de la fonction query est raté on affiche ça
        echo "Il s'est passé une erreur lors de la récupération du fichier, assurez vous d'avoir fourni un bon ID de fichier...<br />";
        echo "<a href='./'>Revenir à la page d'édition</a>";
        exit;
    }
    else { //Sinon
        $file = $file_tbl->fetch(PDO::FETCH_ASSOC); //On get toute la table
        if (is_bool($file)) {   //Et si il n'y a rien alors on envoi un message d'errreur
            echo "Il s'est passé une erreur lors de la récupération du fichier, assurez vous d'avoir fourni un bon ID de fichier..<br />";
            echo "<a href='./'>Revenir à la page d'édition</a>";
            exit;
        }
    }
    $array_keys = array_keys($file);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://chronique-metal.fr/src/libs/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src="https://chronique-metal.fr/src/libs/tinymce/js/tinymce/tinymce.min.js?apiKey=qdf03k88r44modd3h8aiakk7ufuj2igiwueenv907ndhj9yz"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link href="./edit_file.css" rel="stylesheet" type="text/css"/>    
    <script src="./edit_file.js"></script>
    <title>Admin - Chronique Metal</title>
</head>
<body>
    <h1 class="title">Editer ou supprimer un document :</h1>
    <main id="main">
        <div id="disp_file">
            <h3>Fichier sélectionné :</h3>
            <table>
                <tr>
                    <?php foreach($array_keys as $key) echo '<td>'.$key.'</td>'; ?>
                </tr>
                <tr>
                    <?php foreach($file as $attr) echo '<td class="td" data-key="'.array_search($attr, $file).'">'.str_process($attr).'</td>'; ?>
                </tr>
            </table>
        </div><br />
            <a href="#" class="del">Supprimer le Fichier</a><br />
            <div class="status"></div>
            <a href="../">Revenir à la page d'administration</a>
            <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
        </div>
    </main>
    <div id="modal_edit">
        <div id="ctrl">
            <a href="#" class="confirm">Confirmer</a>
            <a href="#" class="cancel">Annuler</a>
        </div>
    </div>
</body>
<script>
    var attr = <?php print_r(json_encode($array_keys)); ?>;
    var table = <?php print_r(json_encode($file)); ?>;
    var type = "<?php echo $_GET['type']; ?>";
    var id = <?php echo $_GET['id']; ?>;
</script>
</html>
