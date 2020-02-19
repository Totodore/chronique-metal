<?php 
    include '../../src/html/system/init.php';
?>
<?php
    if (isset($_POST['add_time_start'])) {
        echo "<p>Ajout d'un horaire hebdomadaire...</p>";
        $time_start = new DateTime($_POST['add_time_start']);
        $time_end = new DateTime($_POST['add_time_end']);
        $duration = strtotime($_POST['add_time_end']) - strtotime($_POST['add_time_start']);
        $duration -= 3600;
        $duration = date("G:i", $duration);
        $day = $_POST['add_day'];
        $date = new DateTime('11/11/1111');
        $name = $_POST['radio_name'];

        $query = $bdd->prepare('INSERT INTO live_programme (name, time_start, time_end, duration, day, date) 
        VALUES(:name, :time_start, :time_end, :duration, :day, :date)');
        if (!$query->execute(array(
            'name' => $name,
            'time_start' => $time_start->format('H:i'),
            'time_end' => $time_end->format('H:i'),
            'duration' => $duration,
            'day' => $day,
            'date' => $date->format('Y-m-d')
        )))
        print_r($query->errorInfo());
        else
        echo "<p>Base de données mise à jour !</p>";
    }
    else if (isset($_POST['add_temp_time_start'])) {
        echo "<p>Ajout d'un horaire temporaire...</p>";
        $time_start = new DateTime($_POST['add_temp_time_start']);
        $time_end = new DateTime($_POST['add_temp_time_end']);
        $date = new DateTime($_POST['add_temp_date']);
        $name = $_POST['radio_name'];
        $duration = strtotime($_POST['add_temp_time_end']) - strtotime($_POST['add_temp_time_start']);
        $duration -= 3600;
        $duration = date("G:i", $duration);
        
        $query = $bdd->prepare('INSERT INTO live_programme (name, time_start, time_end, duration, day, date) 
        VALUES(:name, :time_start, :time_end, :duration, :day, :date)');
        if(!$query->execute(array(
            'name' => $name,
            'time_start' => $time_start->format('H:i'),
            'time_end' => $time_end->format('H:i'),
            'duration' => $duration,
            'day' => '',
            'date' => $date->format('Y-m-d')
        )))
        print_r($query->errorInfo());
        else
        echo "<p>Base de données mise à jour !</p>";
    }
?>
<table><tr><th>Nom</th><th>Heure de début</th><th>Heure de fin</th><th>Durée</th><th>Jour de la semaine</th><th>Date</th><th>Régulié</th><th>ID</th></tr>
<?php 
$table = $bdd->query("SELECT * from live_programme");
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