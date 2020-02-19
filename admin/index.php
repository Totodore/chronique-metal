<?php include '../src/html/system/init.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
    <style>
        .title {
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
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
        }
        #main > a {
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
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        #main > a:hover {
            border-color: rgb(46, 46, 46);
        }
    </style>
</head>
    <body style="text-align: center; font-size:1.2em;">
        <h1 class="title">Page d'administration :</h1>
        <main id="main">
            <a href="./add_operations/add_photos.php">Ajouter un album photo lors d'un concert</a>
            <a href="./add_operations/add_radio.php">Paramétrer des horaires de passage en live radio</a>
            <a href="./add_operations/add_radio_chronique.php">Ajouter un lien vers un article provenant de Radio Metal Sound</a>
            <a href="./add_operations/add_sponsort.php">Ajouter un sponsors</a>
            <a href="./add_operations/">Ajouter un type de document</a>
            <a href="./post_operations/">Editer ou Supprimer</a>
            <a href="./mail.php?subject=radio">Notifier tout le monde que je suis en live !</a>
            <a href="https://chronique-metal.fr">Revenir au site de Chronique Metal</a>
        </main>
    </body>
</html>