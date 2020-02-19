<?php include '../../src/html/system/init.php'; 
$table = $bdd->query("SELECT * from live_programme");
?>
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
            max-width: 95%;
            margin: auto;
            padding: 20px;
            padding-left: 10px;
            padding-right: 10px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        #set > h4 {
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align: center;
        }
        form {
            text-align: center;
            width: 100%;
        }
        form > input {
            border: gray 4px solid;
            transition: all 400ms;
            border-radius: 4px;
            padding: 4px;
            width: 50%;
            margin: 10px;
        }
        form > input:hover, .form > input:focus {
            border-color: rgb(46, 46, 46);            
        }
        form > input[type='file'], form > input[type='submit'], form > select {
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            border-radius: 4px;
            margin: auto;
            width: -moz-fit-content;
            width: fit-content;
            width: -webkit-fit-content;
        }
        table, th, td {
            border: 2px solid grey;
        }
        .status > a {
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
        .status > p {
            text-align: center;
        }
        .status > a:hover {
            border-color: rgb(46, 46, 46);
        }
    </style>
</head>
<body>
    <h1 class="title">Ajouter des horaires des passages en live radio :</h1>
    <main id="main">
        <div id="set"> 
            <h4>Ajouter un horaire hebdomadaire :</h4>
            <form method="POST">
                <input type="text" placeholder="Nom de l'émission :" name="radio_name"/><br />
                <label>Jour de la semaine : </label>
                <select name="add_day">
                    <option>Lundi</option>
                    <option>Mardi</option>
                    <option>Mercredi</option>
                    <option>Jeudi</option>
                    <option>Vendredi</option>
                    <option>Samedi</option>
                    <option>Dimanche</option>
                </select><br /><br />
                <label>Heure de début de l'émission : </label><br />
                <input type="time" name="add_time_start"/><br />
                <label>Heure de fin de l'émission: </label><br />
                <input type="time" name="add_time_end"/>
                <input type="submit" />
            </form>
            <h4>Ajouter un horaire unique :</h4>
            <form method="POST">
                <input type="text" placeholder="Nom de l'émission :" name="radio_name"/><br />
                <label>Jour de l'émission : </label><br />
                <input type="date" name="add_temp_date"/><br />
                <label>Heure de début de l'émission :</label><br />
                <input type="time" name="add_temp_time_start"/><br />
                <label>Heure de fin de l'émission :</label><br />
                <input type="time" name="add_temp_time_end"/><br />
                <input type="submit"/>
            </form><br />
        </div>
        <div class="status">
            <table><tr><th>Nom</th><th>Heure de début</th><th>Heure de fin</th><th>Durée</th><th>Jour de la semaine</th><th>Date</th><th>Regulié</th><th>ID</th></tr>
            <?php 
            while ($line = $table->fetch()) {
                if ($line['day'] == '')
                    $tmp = "Non";
                else
                    $tmp = "Oui ";
                echo "<tr><th>".$line['name']."</th><th>".$line['time_start']."</th><th>".$line['time_end']."</th><th>".$line['duration']."</th><th>".$line['day']."</th><th>".$line['date']."</th><th>".$tmp."</th><th>".$line['ID']."</th></tr>";
            }
            ?>
            </table>
            <p>Note : Les horaires passées seront automatiquement supprimées.</p>
            <p>Note : Le format de l'heure peut varier suivant l'humeur du navigateur, en format 12h, il faut penser à mettre AM ou PM derrière.</p>
            <a href="../">Revenir a la page d'administration</a>
            <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
        </div>
    </main>
</body>
<script type="text/javascript">
    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "add_radio_ajax.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".status").html("Requête en cours");
                },
                success: function(data) {
                    $(".status").html(data);
                    $("form").each(function() { this.reset(); });
                    $("form").children().each(function() {
                        this.disabled = false;
                    })
                }
            })
        })
        $("form").on("input", function() {
            $("form").not(this).children().each(function() {
                this.disabled = true;
            })
        });
    });
</script>