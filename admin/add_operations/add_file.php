<?php 
    include '../../src/html/system/init.php';
    $file = $bdd->query('SELECT * from '.$_POST['type']);
    $array_keys = array_keys($file->fetch(PDO::FETCH_ASSOC));
    $specialAttr = Array();
?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/src/libs/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script src="/src/libs/tinymce/js/tinymce/tinymce.min.js?apiKey=qdf03k88r44modd3h8aiakk7ufuj2igiwueenv907ndhj9yz"></script>
    <script src="add_file.js"></script>
    <link href="add_file.css" rel="stylesheet" type="text/css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
</head>
<body>
    <h1>Ajout d'un document dans <?php echo $_POST['type'] ?></h1>
    <div id="disp_table">
    <h3>Fichier à ajouter :</h3>
            <table>
                <tr class="labels">
                    <?php foreach($array_keys as $key) {
                            echo '<td>'.$key.'</td>';
                    } ?>
                </tr>
            </table><br />
    </div>
    <form enctype="multipart/form-data" method="POST" class="form_edit">
        <?php 
        echo "<input type='text' style='display: none;' readOnly name='type' value='" . $_POST['type'] . "' />";
        foreach($array_keys as $key) {
            echo "<label>".$key." : </label>"; 
            if ($key == "date") echo "<input type='date' required name='".$key."' /><br /><br />";
            else if ($key == "text") echo "<textarea class='text' name='".$key."'></textarea><br />";
            else if ($key == "url") echo "<input type='url' required name='".$key."' /><br /><br />";
            else if ($key == "ID") echo "ID automatique<br /><br />";
            else if ($key == "type") continue;
            else echo "<input type='text' required name='".$key."' /><br /><br />";
        } ?>
        <input type="submit" class="register_all" value="Ajouter à la base de donnée ! " />
    </form>
    <progress max="100"></progress>
    <div class="status"></div>
    <br /><br /><br />
    <a href="/">Revenir a la page d'accueil</a><br />
    <a href="../">Revenir a la page d'administration</a><br /><br /><br /><br />
</body>
</html>