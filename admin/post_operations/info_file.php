<?php 
    include '../../src/html/system/init.php';
    $id = $_POST['file'];
    $type = $_POST['type'];

    $file = $bdd->query('SELECT * from '.$type.' where ID='.$id)->fetch(PDO::FETCH_ASSOC);
    $array_keys = array_keys($file);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
    <style>
        body {
            width: -moz-fit-content;
            width: fit-content;
            margin: auto;
        }
        td, th {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
            background-color: grey;
        }
        #choice {
            width: -moz-fit-content;
            margin: auto;
            width: fit-content;
        }
    </style>
</head>
<body>
    <div id="disp_file">
        <h3>Fichier sélectionné :</h3>
        <table>
            <tr>
                <?php foreach($array_keys as $key) echo '<td>'.$key.'</td>'; ?>
            </tr>
            <tr>
                <?php foreach($file as $attr) echo '<td>'.stripslashes($attr).'</td>'; ?>
            </tr>
        </table>
    </div>
    <div id="choice">
        <h1>Editer ou supprimer un document :</h1>
        <h3>Opérations possibles : </h3>
        <a href="edit_file.php?id=<?php echo $id ?>&type=<?php echo $type?>">Editer le Fichier</a><br /><br />
        <a href="delete_file.php?id=<?php echo $id ?>&type=<?php echo $type?>">Supprimer le Fichier</a><br /><br />
        <br />
        <br />
        <br />
        <a href="/">Revenir a la page d'accueil</a><br />
        <a href="index.php">Revenir a la page d'administration</a><br />
        <a href="./">Revenir à la page d'edition</a><br />
    </div>
</body>
</html>