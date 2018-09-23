<?php include '../../src/html/system/init.php';
$file = $bdd->query('SELECT * from '.$_POST['type']);    
$array_keys = array_keys($bdd->query('SELECT * from '.$_POST['type'])->fetch(PDO::FETCH_ASSOC));
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
            display: block;
        }
        td, th {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
            overflow: auto;
            max-height: 600px;
            max-width: 900px;
            background-color: grey;
        }
        .labels {
            font-weight: 900;
        }
        .file_type {
            display: none;
        }
        #disp_file {
            /* max-height: 500px;
            overflow: auto;
            border: 5px solid grey;
            padding: 5px; */
        }
        .choose_file {
            width: -moz-fit-content;
            width: fit-content;
            margin: auto;
        }
    </style>

</head>
<body>
    <h1>Editer ou supprimer un document :</h1>
    <div id="disp_file">
        <h3>Liste des fichiers :</h3>
        <table>
            <tr class="labels">
                <?php foreach($array_keys as $key) echo '<td>'.$key.'</td>'; ?>
            </tr>
            <?php foreach ($file->fetchAll(PDO::FETCH_ASSOC) as $line) { ?>
            <tr>
                <?php foreach($line as $attr) {
                    if (str_word_count($attr) > 50 ) { //si le text est plus long que 50 alors on affiche que les 50 mots.
                        echo '<td>';
                        echo stripslashes(implode(" ", array_slice(explode(" ", $attr, 50), 0, 48)));
                        echo ' ...</td>';
                    }
                    else
                        echo '<td>'.stripslashes($attr).'</td>'; 
                }
                ?>
            </tr>
            <?php }  ?>
        </table>
    </div>
        <form method="POST" class="choose_file" action="info_file.php">
            <h3 class="file_label">Type sélectionné : <?php echo $_POST['type'] ?></h3>
            <h3>Selectionnez l'ID du fichier :</h3>
            <input type="text" readOnly value="<?php echo $_POST['type'] ?>" name="type" class="file_type"/>
            <input type="number" required name="file" class="list" /><br /><br />
            <input type="submit" value="Valider" /><br /><br />
        </form>
    </div>  
    <br />
    <br />
    <br />
    <a href="/">Revenir a la page d'accueil</a><br />
    <a href="../">Revenir a la page d'administration</a><br />
    <a href="./">Revenir à la page d'edition</a><br />
</body>
<script>
    var datas = Array();
    var title;
    $(function() {
    });
</script>
</html>