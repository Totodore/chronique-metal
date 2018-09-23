<?php include '../../src/html/system/init.php'; ?>
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
        .choose_file {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Choisissez un type de document :</h1>
    <form method="POST" class="choose_type" action="choose_file.php">
        <h3>Type :</h3>
        <select class="type" name="type">
            <option value="chroniques">chroniques</option>
            <option value="interviews">interviews</option>
            <option value="concerts">concerts</option>
            <option value="live_programme">Programme Radio</option>
            <option value="notifications">Personnes notifiées</option>
            <option value="playlists">playlists</option>
            <option value="sponsorts">sponsors</option>
            <option value="photos">photos</option>
            <option value="last_chronique">Chroniques de radio metal sound</option>
            <option value="comments">commentaires</option>
        </select><br />
        <input type="submit" value="Valider" />
    </form><br />
    <a href="/">Revenir a la page d'accueil</a><br />
    <a href="../">Revenir a la page d'administration</a><br />
</body>
</html>
