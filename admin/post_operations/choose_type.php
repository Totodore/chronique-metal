<?php include '../../src/html/system/init.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Admin - Chronique Metal</title>
    <style> 
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
        form > select {
            margin-top: 10px;
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
    <h1 class="title">Choisissez un type de document :</h1>
    <main id="main">
        <form method="POST" class="choose_type" action="choose_file.php">
            <label>Type :</label><br />
            <select class="type" name="type">
                <option value="chroniques">chroniques</option>
                <option value="interviews">interviews</option>
                <option value="concerts">concerts</option>
                <option value="notifications">Personnes notifiées</option>
                <option value="playlists">playlists</option>
                <option value="sponsorts">sponsors</option>
                <option value="photos">photos</option>
                <option value="last_chronique">Chroniques de radio metal sound</option>
                <option value="comments">commentaires</option>
                <option value="annouces">annonces</option>
            </select><br />
            <input type="submit" value="Valider" />
        </form><br />
        <a href="../">Revenir à la page d'administration</a>
        <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
    </main>
</body>
</html>
