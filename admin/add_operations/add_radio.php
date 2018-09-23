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
        th {
            border: 1px solid black;
        }
    </style>
</head>
<body style="display: flex;">
    <div> 
        <h4>Ajouter un horaire regulie par semaine :</h4>
        <form method="POST">
            <input type="text" placeholder="Nom de l'emission" name="radio_name"/><br /><br />
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
            <label>heure de debut de l'emission : </label>
            <input type="time" name="add_time_start"/><br /><br />
            <label>heure de fin de l'emission: </label>
            <input type="time" name="add_time_end"/><br /><br />
            <input type="submit" />
        </form><br />
        <h4>Ajouter un horaire unique :</h4>
        <form method="POST">
            <input type="text" placeholder="Nom de l'emission" name="radio_name"/><br /><br />
            <label>Jour de l'emission : </label>
            <input type="date" name="add_temp_date"/><br /><br />
            <label>heure de debut de l'emission :</label>
            <input type="time" name="add_temp_time_start"/><br /><br />
            <label>heure de fin de l'emission :</label>
            <input type="time" name="add_temp_time_end"/><br /><br />
            <input type="submit"/>
        </form><br />
        <input type="button" value="reset" class="reset"/><br />
    </div>
    <div class="status" style="margin-left: 50px;">
        <table><tr><th>Nom</th><th>Heure de debut</th><th>Heure de fin</th><th>Duree</th><th>Jour de la semaine</th><th>Date</th><th>Regulie</th><th>ID</th></tr>
        <?php 
        while ($line = $table->fetch()) {
            if ($line['day'] == '')
                $tmp = "Non";
            else
                $tmp = "Oui ";
            echo "<tr><th>".$line['name']."</th><th>".$line['time_start']."</th><th>".$line['time_end']."</th><th>".$line['duration']."</th><th>".$line['day']."</th><th>".$line['date']."</th><th>".$tmp."</th><th>".$line['ID']."</th></tr>";
        }
        ?>
        </table><br /><br />
        <p>Note : Les horaires passées ne seront pas affichées mais il faut quand même penser à les supprimer.</p>
        <p>Note : L'heure est à rentrer au format 24h</p>
        <a href="../">Revenir au menu Admin</a><br />
        <a href="/">Revenir a la page d'accueil du site</a>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            console.log("Sending Form...");
            $.ajax({
                url: "add_radio_ajax.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".status").html("Requete en cours");
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
        $(".reset").click(function reset() {
            $("form").children().each(function() {
                this.disabled = false;
            })
            $("form").each(function() {
                this.reset();
            })
        })
    });
</script>