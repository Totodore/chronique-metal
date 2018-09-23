<?php 
    include '../../src/html/system/init.php';
?>
<?php
    if (isset($_POST['add_time_start'])) {
        echo "Ajout d'un horaire periodique...<br />";
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
        echo "Base de donnees mise a jour !<br /><br />";
    }
    else if (isset($_POST['add_temp_time_start'])) {
        echo "Ajout d'un horaire temporaire...<br />";
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
        echo "Base de donnees mise a jour !<br /><br />";
    }
?>
<table><tr><th>Nom</th><th>Heure de debut</th><th>Heure de fin</th><th>Duree</th><th>Jour de la semaine</th><th>Date</th><th>Regulie</th><th>ID</th></tr>
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
</table><br /><br />
<p>Note : Les horaires temporaires seront automatiquement supprimes une fois passee.</p>
<p>Note : L'heure est à rentrer au format 24h</p>
<a href="../">Revenir au menu Admin</a><br />
<a href="/">Revenir a la page d'accueil du site</a>