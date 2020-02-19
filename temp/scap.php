<?php

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    use duzun\hQuery;
    $bdd = new PDO('mysql:host=chroniquay12.mysql.db;dbname=chroniquay12;charset=utf8', 'chroniquay12', 'Chroniquay12', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    include_once './vendor/duzun/hquery/hquery.php';

    $code = hQuery::fromUrl($_POST['url']);
    $title = reset($code->find_text(".widget-title"));
    $date = reset($code->find_text(".article-date"));
    $date = DateTime::createFromFormat('d/m/Y H:i', $date);
    $date = $date->format('Y-m-d');
    $text = reset($code->find_html(".widget-content"));
    print_r($text);
    $author = $_POST['author'];
    $type = $_POST['type'];
    echo "Url : ".$_POST['url'];
    echo "<br />Titre : ".$title;
    echo "<br />Date : ".$date;
    echo "<br />Text :<br />".$text;
    echo "<br /><br />Auteur :".$author;
    echo "<br />Type :".$type;

    $query = $bdd->prepare("INSERT INTO ".$type." (titre, auteur, text, date, type) VALUES (:titre, :auteur, :text, :date, :type)");
    if (!$query->execute(Array(
        "titre" => $title,
        "auteur" => $author,
        "text" => $text,
        "date" => $date,
        "type" => $type
    ))) 
        print_r($query->errorInfo());
    else 
        echo "<br />BDD mise à jour !";
?>
<a href="./include.html">Revenir à la page d'inclusion dynamique</a>
