<?php include '../../src/html/system/init.php';
function str_process($str, $size) {
        $str = stripslashes($str);  //On supprimes les backslashes de protection
        $str = strip_tags($str); //On vire tous les tags html
        $str = explode(" ", $str, $size);  //on separe la str en array
        $str = array_slice($str, 0, $size-2);    //On prend les 48 premiers mots
        $str = implode(" ", $str); //On reconvertit en str
        return $str;
    }
$file = $bdd->query('SELECT * from '.$_POST['type'])->fetchAll(PDO::FETCH_ASSOC);    
if ($file) {
    $file_keys = $bdd->query('DESCRIBE '.$_POST['type']);
    $file_keys = $file_keys->fetchAll(PDO::FETCH_ASSOC);
    $array_keys = Array();
    foreach ($file_keys as $column) {
        array_push($array_keys, $column['Field']);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
    <style> 
        td, th, table {
            border: 2px solid grey;
        }
        .link {
            transition: all 400ms;
            cursor: pointer;
        }
        .link:hover {
            background-color: rgba(46, 46, 46, 0.2);
        }
        table {
            border-collapse: collapse;
            overflow: auto;
            max-height: 600px;
            max-width: 900px;
        }
        .labels {
            font-weight: 900;
            text-align: center;
        }
        .title {
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align: center;
        }
        #main {
            background-color: whitesmoke;
            box-shadow: 0px 0px 40px 7px black;
            width: -moz-fit-content;
            width: fit-content;
            width: -webkit-fit-content;
            height: -moz-fit-content;
            height: fit-content;
            height: -webkit-fit-content;
            margin: auto;
            padding: 20px;
            padding-left: 10px;
            padding-right: 10px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-align: center;
        }
        form {
            width: 100%;
            text-align: center;
        }
        form > input {
            border: gray 4px solid;
            transition: all 400ms;
            border-radius: 4px;
            padding: 4px;
            width: 250px;
            margin: 10px;
        }
        form > input:hover, form > input:focus {
            border-color: rgb(46, 46, 46);            
        }
        form > input[type='submit'] {
            cursor: pointer;
        }
        a {
            padding: 5px;
            border: grey solid 4px;
            border-radius: 4px;
            text-decoration: none;
            color: black;
            transition: all 400ms;
            display: block;
            width: -moz-fit-content;
            width: fit-content;
            width: -webkit-fit-content;
            margin: auto;
            margin-bottom: 13px;
        }
        a:hover {
            border-color: rgb(46, 46, 46);
        }
    </style>
</head>
<body>
    <h1 class="title">Editer ou supprimer un document :</h1>
    <main id="main">
        <?php if ($file) { ?> 
        <div id="disp_file">
            <h3>Liste des fichiers :</h3>
            <table>
                <tr class="labels">
                    <?php foreach($array_keys as $key) echo '<td>'.$key.'</td>'; ?>
                </tr>
                <?php foreach ($file as $line) { ?>
                <tr class="link" data-href="./info_file.php?id=<?php echo $line['ID']?>&type=<?php echo $_POST['type'] ?>">
                    <?php foreach($line as $attr) {
                        if (str_word_count($attr) > 50) { //si le text est plus long que 50 alors on affiche que les 50 mots.
                            echo '<td>';
                            echo str_process($attr, 50);
                            echo ' ...</td>';
                        }
                        else if ($_POST['type'] == "annouces" ) {
                            echo '<td>';
                            echo stripslashes(strip_tags($attr));
                            echo '</td>';
                        }
                        else
                            echo '<td>'.stripslashes($attr).'</td>'; 
                    }
                    ?>
                </tr>
                <?php }  ?>
            </table><br />
        </div>  
        <?php } else {?>
            <p>Impossible de récupérer des données depuis la table <?php echo $_POST['type'] ?>, il est possible que celle-ci soit vide.</p>
        <?php } ?>
        <a href="../">Revenir à la page d'administration</a>
        <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
    </main>
</body>
<script>
    var datas = Array();
    var title;
    $(function() {
        $(".link").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
</html>