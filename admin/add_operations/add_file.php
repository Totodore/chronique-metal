<?php 
    include '../../src/html/system/init.php';
    $file = $bdd->query('DESCRIBE '.$_POST['type']);
    $file = $file->fetchAll(PDO::FETCH_ASSOC);
    $array_keys = Array();
    foreach ($file as $column) {
        array_push($array_keys, $column['Field']);
    }
    $specialAttr = Array();
?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://chronique-metal.fr/src/libs/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script src="https://chronique-metal.fr/src/libs/tinymce/js/tinymce/tinymce.min.js?apiKey=qdf03k88r44modd3h8aiakk7ufuj2igiwueenv907ndhj9yz"></script>
    <script src="add_file.js"></script>
    <link href="add_file.css" rel="stylesheet" type="text/css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
</head>
<body>
    <h1 class="title">Ajout d'un document dans <?php echo $_POST['type'] ?> :</h1>
    <main id="main">
        <form enctype="multipart/form-data" method="POST" class="form_edit">
            <?php 
            echo "<input type='text' style='display: none;' readOnly name='type' value='" . $_POST['type'] . "' />";
            foreach($array_keys as $key) {
                if ($key == "date") echo "<label>".$key." : </label><br /><input type='date' required name='".$key."' /><br />";
                else if ($key == "text") echo "<textarea class='text' name='".$key."'></textarea><br />";
                else if ($key == "url") echo "<label>".$key." : </label><br /><input type='url' required name='".$key."' /><br />";
                else if ($key == "ID") continue;
                else if ($key == "type") continue;
                else echo "<input type='text' placeholder='".$key." :' required name='".$key."' /><br />";
            } ?>
            <input type="submit" class="register_all" value="Ajouter à la base de donnée ! "/><br /><br />
        </form>
        <progress max="100" value="50"></progress>
        <div class="status"></div>
        <a href="../">Revenir à la page d'administration</a>
        <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
    </main>
</body>
</html>