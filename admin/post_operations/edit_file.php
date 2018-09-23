<?php 
    include '../../src/html/system/init.php';
    $id = $_GET['id'];
    $type = $_GET['type'];

    $file = $bdd->query('SELECT * from '.$type.' where ID='.$id)->fetch(PDO::FETCH_ASSOC);
    $array_keys = array_keys($file);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/src/libs/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src="/src/libs/tinymce/js/tinymce/tinymce.min.js?apiKey=qdf03k88r44modd3h8aiakk7ufuj2igiwueenv907ndhj9yz"></script>
    <script type="text/javascript" src="edit_file.js"></script>
    <link type="text/css" rel="stylesheet" href="edit_file.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
</head>
<body>
    <div id="disp_file">
        <h3>Fichier sélectionné :</h3>
        <table>
            <tr>
                <?php foreach($array_keys as $key) echo '<td>'.$key.'</td>'; ?>
            </tr>
            <tr>
                <?php foreach($file as $attr) echo '<td>'.stripslashes($attr).'</td>';  ?>
            </tr>
        </table>
    </div>
    <div id="forms">
        <form class="choose_edit">
            <h5>Que voulez vous éditer ?</h5>
            <select class="attr" name="attr">
            </select><br />
            <input type="submit" value="valider" /><br /><br /><br />
        </form>
        <form method="POST" class="edit">
            <h5 class="edit_title"></h5>
            <input type="text" readOnly value="<?php echo $type ?>" name="type" class="data"/>
            <input type="text" readOnly value="<?php echo $id ?>" name="id" class="data"/>
            <input type="text" readOnly value="" name="attr" class="data type"/>
            <div class="wrapper_editor"><textarea class="edit_text" name="content_text" ></textarea></div><br />
            <input class="edit_input" type="text" name="content_input" ><br />
            <input type="submit" value="Terminé" class="submit_edit"/><br /><br />
        </form>
        <br />
        <br />
        <div class="status"></div>
        <br />
        <br />
        <br />
        <a href="/">Revenir a la page d'accueil</a><br />
        <a href="../">Revenir a la page d'administration</a><br />
        <a href="./">Revenir à la page d'edition</a><br />
    </div>
</body>
<script>
    var attr = <?php print_r(json_encode($array_keys)); ?>;
    var table = <?php print_r(json_encode($file)); ?>;
    var type = "<?php echo $type; ?>";
    var id = <?php echo $id; ?>;
</script>
</html>