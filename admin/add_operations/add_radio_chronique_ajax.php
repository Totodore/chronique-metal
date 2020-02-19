<?php 
    include "../../src/html/system/init.php";
    if (isset($_POST['link']))
        $link = $_POST['link'];
    else 
        exit;
    if (isset($_POST['title']))
        $title = $_POST['title'];
    else 
        exit;
    $table = $bdd->query("SELECT * FROM last_chronique");
    $i = 0;
    foreach ($table as $line) {
        $i++;   //On compte combien ya de lignes dans la bdd
    }
    if ($i >= 5) {
        $bdd->query("DELETE FROM last_chronique ORDER BY ID LIMIT 1"); //Si yen a plus de 5 on degage la premiere
    }
    
    $query = $bdd->prepare("INSERT INTO last_chronique (link, title, date) VALUES (:link, :title, NOW())");
    if (!$query->execute(Array(
        "link" => $link, 
        "title" => $title,
    )))
        echo $query->errorInfo();
    else 
        echo "<p>BDD mise à jour !</p>";
?>